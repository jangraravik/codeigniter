<?php

/* session_sample/index.twig */
class __TwigTemplate_08e75e961d650686339ecbbd9c2dd9225305bc1b3bbc64fbb26f4e19949ac847 extends Twig_Template
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
        echo "<p>Nick: ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["session"]) ? $context["session"] : null), "userdata", array()), "nick", array()), "html", null, true);
        echo "</p>

<p>Flashdata: ";
        // line 3
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["session"]) ? $context["session"] : null), "flashdata", array()), "test_sess", array()), "html", null, true);
        echo "</p>

<a href=\"";
        // line 5
        echo twig_escape_filter($this->env, site_url("/session_sample/flash"), "html", null, true);
        echo "\">Go to \"/session_sample/flash\"</a>
";
    }

    public function getTemplateName()
    {
        return "session_sample/index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  30 => 5,  25 => 3,  19 => 1,);
    }
}
/* <p>Nick: {{ session.userdata.nick }}</p>*/
/* */
/* <p>Flashdata: {{ session.flashdata.test_sess }}</p>*/
/* */
/* <a href="{{ site_url('/session_sample/flash') }}">Go to "/session_sample/flash"</a>*/
/* */
