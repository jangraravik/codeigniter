<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Error logger for CodeIgniter
 */

class Errorlog
{
  private $CI;
  private $configuration;
  public $levels = array(
      E_ERROR             => 'Error',
      E_WARNING           => 'Warning',
      E_PARSE             => 'Parsing Error',
      E_NOTICE            => 'Notice',
      E_CORE_ERROR        => 'Core Error',
      E_CORE_WARNING      => 'Core Warning',
      E_COMPILE_ERROR     => 'Compile Error',
      E_COMPILE_WARNING   => 'Compile Warning',
      E_USER_ERROR        => 'User Error',
      E_USER_WARNING      => 'User Warning',
      E_USER_NOTICE       => 'User Notice',
      E_STRICT            => 'Runtime Notice',
      E_RECOVERABLE_ERROR => 'Catchable error',
      E_DEPRECATED        => 'Runtime Notice',
      E_USER_DEPRECATED   => 'User Warning'
  );  
  private $table_fields = array(
        array('name' => 'id', 'type' => 'int', 'primary_key' => 1, 'forge_type' => 'int', 'forge_auto_increment' => TRUE),
        array('name' => 'err_no', 'type' => 'int', 'forge_type' => 'int'),
        array('name' => 'err_type', 'type' => 'string', 'forge_type' => 'varchar', 'forge_constraint' => '20'),
        array('name' => 'err_str', 'type' => 'string', 'forge_type' => 'text'),
        array('name' => 'err_file', 'type' => 'string', 'forge_type' => 'text'),
        array('name' => 'err_file_line', 'type' => 'int', 'forge_type' => 'int'),
        array('name' => 'visitor_user_agent', 'type' => 'string', 'forge_type' => 'text'),
        array('name' => 'visitor_ip', 'type' => 'string', 'forge_type' => 'varchar', 'forge_constraint' => '20'),
        array('name' => 'date_time', 'type' => 'string', 'forge_type' => 'varchar', 'forge_constraint' => '30')
    );

  public function __construct()
  {
    $result = $this->initialize();
    if ($result === FALSE){
      return FALSE;
    } else{
      set_error_handler(array($this, 'error_handler'));
      set_exception_handler(array($this, 'exception_handler'));
    }
  }

  /**
   * Initialization script Checks the environment to ensure that the library will run.
   */
  public function initialize()
  {
    //connect to CodeIgnitor
    if ( ! $this->CI =& get_instance())
    {
      echo "The Error Log library is built for CodeIgnitor 1.6.3 and cannot be used outside of CI.";
      exit();
    }

    //if php is not new enough, show error and die.
    if (phpversion() < 5.1)
    {
      show_error('The Error Log library is supported only on PHP v5.1 and above!');
      return FALSE;
    }

    //check for the configuration file
    if ( ! $this->CI->config->load('errorlog_config') OR $this->CI->config->item('errorlog') === FALSE)
    {
      show_error("Missing the configuration for Error Log.  Ensure you have installed Error Log correctly.");
      return FALSE;
    }

    //Load the configuration
    $this->configuration = $this->CI->config->item('errorlog');

    //check the database for the table
    if ( ! $this->check_database())
    {
      show_error("The database is not setup correctly for Error Log.  Check to ensure proper database setup, or check the config settings for tracklog.");
      return FALSE;
    }

    //if made it here
    return TRUE;
  }

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

    public function error_handler($severity, $message, $filepath, $line)
    {
        $data = array(
            'err_no' => $severity,
            'err_type' => isset($this->levels[$severity]) ? $this->levels[$severity] : $severity,
            'err_str' => $message,
            'err_file' => $filepath,
            'err_file_line' => $line,
            'visitor_user_agent' => $this->CI->input->user_agent(),
            'visitor_ip' => $this->CI->input->ip_address(),
            'date_time' => date("Y-m-d h:i:s a")
        );
        $this->CI->db->insert($this->configuration['table_name'], $data);
    }

    public function exception_handler($exception)
    {
        $data = array(
            'err_no' => $exception->getCode(),
            'err_type' => isset($this->levels[$exception->getCode()]) ? $this->levels[$exception->getCode()] : $exception->getCode(),
            'err_str' => $exception->getMessage(),
            'err_file' => $exception->getFile(),
            'err_file_line' => $exception->getLine(),
            'visitor_user_agent' => $this->CI->input->user_agent(),
            'visitor_ip' => $this->CI->input->ip_address(),
            'date_time' => date("Y-m-d h:i:s a")
        );
        $this->CI->db->insert($this->configuration['table_name'], $data);
    }

/*
Use Case on any Controller, Model or View.

## Log Error via error_handler()
  trigger_error("Custom Error via trigger.", E_USER_ERROR);
  trigger_error("Custom Warning via trigger.", E_USER_WARNING);
  trigger_error("Custom Notice via trigger.", E_USER_NOTICE);


## Log Error via exception_handler()
  $date['a'] = 0;
  if (empty($date['a'])) {
    throw new Exception('No input value is provided.', E_USER_WARNING);
}  
  
*/
}