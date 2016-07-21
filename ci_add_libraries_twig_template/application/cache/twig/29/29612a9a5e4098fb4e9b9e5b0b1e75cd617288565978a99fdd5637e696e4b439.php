<?php

/* session_sample/flash.twig */
class __TwigTemplate_d14acb9acec4e7fd06c5c5b4b4fba2e12fe18320ed76ac95d2494d56e3b56e4d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<p>Flashdata: ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["session"]) ? $context["session"] : null), "flashdata", array()), "test_sess", array()), "html", null, true);
        echo "</p>

<a href=\"";
        // line 3
        echo twig_escape_filter($this->env, site_url("/session_sample"), "html", null, true);
        echo "\">Go to \"/session_sample\"</a>
";
    }

    public function getTemplateName()
    {
        return "session_sample/flash.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  25 => 3,  19 => 1,);
    }
}
/* <p>Flashdata: {{ session.flashdata.test_sess }}</p>*/
/* */
/* <a href="{{ site_url('/session_sample') }}">Go to "/session_sample"</a>*/
/* */
