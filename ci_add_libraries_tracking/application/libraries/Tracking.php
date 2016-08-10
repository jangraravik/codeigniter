<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * User Tracking with Activity Log for CodeIgniter
 */

class Tracking
{
  private $CI;
  private $configuration;

  private $table_fields = array(
      array('name' => 'id', 'type' => 'int', 'primary_key' => 1, 'forge_type' => 'int', 'forge_auto_increment' => TRUE),
  		array('name' => 'user_or_sess_id', 'type' => 'string', 'forge_type' => 'varchar', 'forge_constraint' => '50'),
  		array('name' => 'date_time', 'type' => 'string', 'forge_type' => 'varchar', 'forge_constraint' => '30'),
  		array('name' => 'visitor_ip', 'type' => 'string', 'forge_type' => 'varchar', 'forge_constraint' => '20'),
      array('name' => 'visitor_user_agent', 'type' => 'string', 'forge_type' => 'text'),      
  		array('name' => 'visitor_activity_log', 'type' => 'string', 'forge_type' => 'text'),
  		array('name' => 'referer_page', 'type' => 'string', 'forge_type' => 'text'),
      array('name' => 'request_uri', 'type' => 'string', 'forge_type' => 'text')
    );

  /**
   * Constructor
   *
   * Does nothing but run the initialization
   * method.
   *
   * @access public
   * @return void|boolean Will return FALSE if the intialization did not succeed.
   */
  public function tracking()
  {
    $result = $this->initialize();

    if ($result === FALSE)
      return FALSE;
  }


	// --------------------------------------------------------------------

  /**
   * Initialization script
   *
   * Checks the environment to ensure that the library
   * will run.
   *
   * @access public
   * @return boolean The result of the intialization process
   */
  public function initialize()
  {
    //connect to CodeIgnitor
    if ( ! $this->CI =& get_instance())
    {
      echo "The UserTracking library is built for CodeIgnitor 1.6.3 and cannot be used outside of CI.";
      exit();
    }

    //if php is not new enough, show error and die.
    if (phpversion() < 5.1)
    {
      show_error('The Usertracking plugin is supported only on PHP v5.1 and above!');
      return FALSE;
    }

    //check for the configuration file
    if ( ! $this->CI->config->load('tracking_config') OR $this->CI->config->item('tracking') === FALSE)
    {
      show_error("Missing the configuration for UserTracking.  Ensure you have installed UserTracking correctly.");
      return FALSE;
    }

    //Load the configuration
    $this->configuration = $this->CI->config->item('tracking');

    //check the database for the table
    if ( ! $this->check_database())
    {
      show_error("The database is not setup correctly for UserTracking.  Check to ensure proper database setup, or check the config settings for tracklog.");
      return FALSE;
    }

    //if made it here
    return TRUE;
  }


  // --------------------------------------------------------------------

  /**
   * Track the current pageview
   *
   * Retrieves information from the session, user agent, and server
   * fields, and then adds a record to the tracking database.
   *
   * @access public
   * @return boolean The result of the tracking action (whether a db record was added or not)
   */
  public function on()
  {
    //load necessary libraries
    $this->CI->load->database();
    $this->CI->load->library('user_agent');
    $this->CI->load->library('session');

    //get the data
    $input_data = array();
    /* Can be a logged in user_id as user_or_sess_id */
    $input_data['user_or_sess_id'] = ($this->CI->session->userdata('user_id') !== null) ? $this->CI->session->userdata('user_id') : session_id();    
    $input_data['request_uri'] = $this->CI->input->server('REQUEST_URI');
    $input_data['date_time'] = date("Y-m-d h:i:s a");
    $input_data['visitor_ip'] = $this->CI->input->server('REMOTE_ADDR');
    $input_data['visitor_user_agent'] = $this->CI->agent->agent_string();
    $input_data['referer_page'] = $this->CI->agent->referrer();

    //Add it to the database
    $this->CI->load->database();
    $result = $this->CI->db->insert($this->configuration['table_name'], $input_data);

    if ($result === FALSE)
      show_error("Could not write to the ".$this->configuration['table_name']." table in the database while trying to add a tracking record.  Double-check configureation and datbase setup for Usertracking library!");

    //Return the database write result
    return $result;
  }

  public function log($activity_log = '')
  {
    //load necessary libraries
    $this->CI->load->database();
    $this->CI->load->library('user_agent');
    $this->CI->load->library('session');

    //get the data
    $input_data = array();
    /* Can be a logged in user_id as user_or_sess_id */
    $input_data['user_or_sess_id'] = ($this->CI->session->userdata('user_id') !== null) ? $this->CI->session->userdata('user_id') : session_id();    
    $input_data['request_uri'] = $this->CI->input->server('REQUEST_URI');
    $input_data['date_time'] = date("Y-m-d h:i:s a");
    $input_data['visitor_ip'] = $this->CI->input->server('REMOTE_ADDR');
    $input_data['visitor_user_agent'] = $this->CI->agent->agent_string();
    $input_data['visitor_activity_log'] = $activity_log;
    $input_data['referer_page'] = $this->CI->agent->referrer();

    //Add it to the database
    $this->CI->load->database();
    $result = $this->CI->db->insert($this->configuration['table_name'], $input_data);

    if ($result === FALSE)
      show_error("Could not write to the ".$this->configuration['table_name']." table in the database while trying to add a tracking record.  Double-check configureation and datbase setup for Usertracking library!");

    //Return the database write result
    return $result;
  }  




  // --------------------------------------------------------------------


  /**
   * Check Database
   *
   * This checks and, if defined in the configuration file, builds the
   * necessary database tables for tracking using the CI database forge class.
   *
   * If it finds a malformed table, it will backup that table and create a new one.
   *
   * @access private
   * @return boolean Whether the database table exists or was setup succesfully.
   */
  private function check_database()
  {
    //load the ci database and db forge classes, or show error & return FALSE
    $this->CI->load->database();
    $this->CI->load->dbforge();

    //check to see if the table exists
    if ($this->CI->db->table_exists($this->configuration['table_name']))
    {
      //if the table exists, check to see if the columns are setup correctly
      $fields = $this->CI->db->field_data($this->configuration['table_name']);

      //if the columns are setup correctly, return TRUE
      $num_matched = 0;
      foreach($this->table_fields as $needed_field)
      {
        $nf_name = $needed_field['name'];
        $nf_type = $needed_field['type'];

        foreach($fields as $the_field)
        {
          if ($the_field->name == $nf_name && $the_field->type = $nf_type)
          {
            $num_matched++;
            break;
          }
        }
      }

      if ($num_matched < count($this->table_fields) && $this->configuration['auto_fix_db'] === TRUE)
      {
        //if the columns are setup incorrectly and autofix_db is on, fix the db and return TRUE

        //rename the table
        global $CI;
        $db_prefix = $CI->db->dbprefix;
        $this->CI->dbforge->rename_table($db_prefix . $this->configuration['table_name'], $this->configuration['table_name'].'_backup_' . time());
        $this->CI->db->query("UNLOCK TABLES;");

        //rebuild the table
        $result = $this->build_database_table();

        //return TRUE
        return $result;
      }
      elseif ($num_matched < count($this->table_fields) && $this->configuration['auto_fix_db'] !== TRUE)
      {
        //if the columns are setup incorrectly and autofix_db is off, show error return FALSE
        show_error('The database table exists, but is malformed and not setup correctly.');
        return FALSE;
      }
      else //everything is setup right
        return TRUE;
    }
    elseif ($this->configuration['auto_build_db'] === TRUE)
    {
      //if the table doesn't exist, and autoBuild_db is on, build the table and return TRUE
      $result = $this->build_database_table();
      return $result;
    }
    else
    {
      //if the table doesn't exist, and autoBuild_db is off, show error and return FALSE
      show_error("The ".$this->configuration['table_name']." database table does not exist.  Check your database installation.");
      return FALSE;
    }
  }

  // --------------------------------------------------------------------


  /**
   * Build Database Table
   *
   * Builds the database table.  If one already exists, it will overwrite.  This method
   * should only be called from the {@link checkDatabase} method to avoid potential
   * data loss.
   *
   * @access private
   * @return boolean Whether the table was built succesfully
   */
  private function build_database_table()
  {
    //load the ci database and db forge classes, or show error & return FALSE (if not already done)
    $this->CI->load->database();
    $this->CI->load->dbforge();

    //create a new table with the appropriate fields
    $new_fields = array();

    foreach($this->table_fields as $curr_nf)
    {
      $name = $curr_nf['name'];
      $new_fields[$name] = array('type' => $curr_nf['forge_type']);
      if (isset($curr_nf['forge_constraint']))
        $new_fields[$name]['constraint'] = $curr_nf['forge_constraint'];
      if (isset($curr_nf['forge_auto_increment']))
        $new_fields[$name]['auto_increment'] = $curr_nf['forge_auto_increment'];

      if (isset($curr_nf['primary_key']) && $curr_nf['primary_key'] == 1)
        $this->CI->dbforge->add_key($name, TRUE);
    }

    $this->CI->dbforge->add_field($new_fields);
    $this->CI->dbforge->create_table($this->configuration['table_name']);
    return TRUE;
  }
}