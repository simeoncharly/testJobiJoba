<?php

/* GetPEOffers.html.twig */
class __TwigTemplate_62237f629f9f0126c0aae414824e1898d2dbf12d58ceffaa6032b12829dac384 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "GetPEOffers.html.twig"));

        // line 1
        echo "<h1 id=\"pageTitle\">O10 dernières offres Pôle Emploi</h1>
<ul>
";
        // line 3
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["results"]) || array_key_exists("results", $context) ? $context["results"] : (function () { throw new Twig_Error_Runtime('Variable "results" does not exist.', 3, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["offers"]) {
            // line 4
            echo "
      <li> ";
            // line 5
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["offers"], "offerName", array()), "html", null, true);
            echo "</li>

";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['offers'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 8
        echo "</ul>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "GetPEOffers.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  46 => 8,  37 => 5,  34 => 4,  30 => 3,  26 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<h1 id=\"pageTitle\">O10 dernières offres Pôle Emploi</h1>
<ul>
{% for offers in results %}

      <li> {{ offers.offerName}}</li>

{% endfor %}
</ul>
", "GetPEOffers.html.twig", "/home/charly/SymfonyStuff/JobiJobaTest/PoleEmploiOffers/templates/GetPEOffers.html.twig");
    }
}
