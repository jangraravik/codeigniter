<p>
<select onchange="javascript:window.location.href='<?php echo base_url(); ?>LangSwitch_ctl/switchLang/'+this.value;">
    <option value="english" <?php if($this->session->userdata('site_lang') == 'english') echo 'selected="selected"'; ?>>English</option>
    <option value="hindi" <?php if($this->session->userdata('site_lang') == 'hindi') echo 'selected="selected"'; ?>>हिंदी</option>  
</select>
</p>
<div class="menu_simple">
<ul>
<li><a href="/"><?php echo $this->lang->line('home');?></a></li>
<li><a href="about"><?php echo $this->lang->line('about');?></a></li>
<li><a href="services"><?php echo $this->lang->line('services');?></a></li>
<li><a href="contact"><?php echo $this->lang->line('contact');?></a></li>
</ul>
<?php echo br(1); ?>
</div>
