<?php

/* GetPEOffers.html.twig */
class __TwigTemplate_c81bc9187fac56b3d2bc4d15e1d753f7116606954314d2d663a7d5a7724b9810 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "GetPEOffers.html.twig"));

        // line 1
        echo "
<html>
  <head>
    ";
        // line 4
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 19
        echo "  </head>
</html>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 4
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 5
        echo "      <link href=\"";
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("css/main.css"), "html", null, true);
        echo "\" rel=\"stylesheet\"/>
      <h1 id=\"pageTitle\">Les 10 dernières offres Pôle Emploi</h1>

      ";
        // line 8
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["results"]) || array_key_exists("results", $context) ? $context["results"] : (function () { throw new Twig_Error_Runtime('Variable "results" does not exist.', 8, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["offers"]) {
            // line 9
            echo "      <div id=\"tile\">
            <h3 id:\"offerName\"> ";
            // line 10
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["offers"], "offerName", array()), "html", null, true);
            echo "</h3>
              <div> <label id=\"subTitle\">Description du poste : </label>";
            // line 11
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["offers"], "description", array()), "html", null, true);
            echo "</div>
              <div> <label id=\"subTitle\">Lieu : </label>";
            // line 12
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["offers"], "place", array()), "html", null, true);
            echo "</div>
              <div> <label id=\"subTitle\">Type de contrat : </label>";
            // line 13
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["offers"], "typeContract", array()), "html", null, true);
            echo "</div>
              <div> <label id=\"subTitle\">Entreprise: : </label>";
            // line 14
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["offers"], "company", array()), "html", null, true);
            echo "</div>
      </div>
      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['offers'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 17
        echo "
    ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "GetPEOffers.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  88 => 17,  79 => 14,  75 => 13,  71 => 12,  67 => 11,  63 => 10,  60 => 9,  56 => 8,  49 => 5,  43 => 4,  34 => 19,  32 => 4,  27 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("
<html>
  <head>
    {% block stylesheets %}
      <link href=\"{{ asset('css/main.css')}}\" rel=\"stylesheet\"/>
      <h1 id=\"pageTitle\">Les 10 dernières offres Pôle Emploi</h1>

      {% for offers in results %}
      <div id=\"tile\">
            <h3 id:\"offerName\"> {{offers.offerName}}</h3>
              <div> <label id=\"subTitle\">Description du poste : </label>{{ offers.description}}</div>
              <div> <label id=\"subTitle\">Lieu : </label>{{ offers.place}}</div>
              <div> <label id=\"subTitle\">Type de contrat : </label>{{ offers.typeContract}}</div>
              <div> <label id=\"subTitle\">Entreprise: : </label>{{ offers.company}}</div>
      </div>
      {% endfor %}

    {% endblock%}
  </head>
</html>
", "GetPEOffers.html.twig", "/home/charly/SymfonyStuff/JobiJobaTest/PoleEmploiOffers/templates/GetPEOffers.html.twig");
    }
}
