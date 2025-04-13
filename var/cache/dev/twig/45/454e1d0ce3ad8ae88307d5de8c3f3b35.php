<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* evenment/_delete_form.html.twig */
class __TwigTemplate_181dd7027bf8c7a663ce41df95f0f7d0 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "evenment/_delete_form.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "evenment/_delete_form.html.twig"));

        // line 2
        yield "
<form method=\"post\" 
      action=\"";
        // line 4
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_evenment_delete", ["id_event" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["evenment"]) || array_key_exists("evenment", $context) ? $context["evenment"] : (function () { throw new RuntimeError('Variable "evenment" does not exist.', 4, $this->source); })()), "id_event", [], "any", false, false, false, 4)]), "html", null, true);
        yield "\" 
      class=\"d-inline\" ";
        // line 6
        yield "      onsubmit=\"return confirm('Êtes-vous sûr de vouloir supprimer définitivement l\\\\'événement \\\\'";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["evenment"]) || array_key_exists("evenment", $context) ? $context["evenment"] : (function () { throw new RuntimeError('Variable "evenment" does not exist.', 6, $this->source); })()), "nom", [], "any", false, false, false, 6), "html", null, true);
        yield "\\\\' ?');\">
    
    <input type=\"hidden\" name=\"_method\" value=\"DELETE\">
    <input type=\"hidden\" name=\"_token\" value=\"";
        // line 9
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete" . CoreExtension::getAttribute($this->env, $this->source, (isset($context["evenment"]) || array_key_exists("evenment", $context) ? $context["evenment"] : (function () { throw new RuntimeError('Variable "evenment" does not exist.', 9, $this->source); })()), "id_event", [], "any", false, false, false, 9))), "html", null, true);
        yield "\">
    
    <button class=\"btn btn-sm btn-danger\" title=\"Supprimer\">
        <i class=\"fas fa-trash-alt\"></i> ";
        // line 13
        yield "        ";
        // line 14
        yield "        <span class=\"d-none d-md-inline\">Supprimer</span>
    </button>
</form>";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "evenment/_delete_form.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  71 => 14,  69 => 13,  63 => 9,  56 => 6,  52 => 4,  48 => 2,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# templates/evenment/_delete_form.html.twig #}

<form method=\"post\" 
      action=\"{{ path('app_evenment_delete', {'id_event': evenment.id_event}) }}\" 
      class=\"d-inline\" {# Affichage en ligne #}
      onsubmit=\"return confirm('Êtes-vous sûr de vouloir supprimer définitivement l\\\\'événement \\\\'{{ evenment.nom }}\\\\' ?');\">
    
    <input type=\"hidden\" name=\"_method\" value=\"DELETE\">
    <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete' ~ evenment.id_event) }}\">
    
    <button class=\"btn btn-sm btn-danger\" title=\"Supprimer\">
        <i class=\"fas fa-trash-alt\"></i> {# Icône plus précise #}
        {# Texte optionnel pour les écrans larges #}
        <span class=\"d-none d-md-inline\">Supprimer</span>
    </button>
</form>", "evenment/_delete_form.html.twig", "C:\\Users\\user\\Desktop\\symfonyfareszakrawicrud\\hamhama\\templates\\evenment\\_delete_form.html.twig");
    }
}
