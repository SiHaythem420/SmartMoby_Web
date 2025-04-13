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

/* evenment/show.html.twig */
class __TwigTemplate_674e0c4274aabf3a7c765bffa8ea5de2 extends Template
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

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "back_base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "evenment/show.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "evenment/show.html.twig"));

        $this->parent = $this->loadTemplate("back_base.html.twig", "evenment/show.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "Détails de l'Événement #";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["evenment"]) || array_key_exists("evenment", $context) ? $context["evenment"] : (function () { throw new RuntimeError('Variable "evenment" does not exist.', 3, $this->source); })()), "id_event", [], "any", false, false, false, 3), "html", null, true);
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 6
        yield "<div class=\"container mt-4\">
    <h1 class=\"mb-4\">Détails de l'événement</h1>

    <div class=\"card\">
        <div class=\"card-body\">
            <table class=\"table\">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <td>";
        // line 15
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["evenment"]) || array_key_exists("evenment", $context) ? $context["evenment"] : (function () { throw new RuntimeError('Variable "evenment" does not exist.', 15, $this->source); })()), "id_event", [], "any", false, false, false, 15), "html", null, true);
        yield "</td>
                    </tr>
                    <tr>
                        <th>Nom</th>
                        <td>";
        // line 19
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["evenment"]) || array_key_exists("evenment", $context) ? $context["evenment"] : (function () { throw new RuntimeError('Variable "evenment" does not exist.', 19, $this->source); })()), "nom", [], "any", false, false, false, 19), "html", null, true);
        yield "</td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td>";
        // line 23
        yield ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["evenment"]) || array_key_exists("evenment", $context) ? $context["evenment"] : (function () { throw new RuntimeError('Variable "evenment" does not exist.', 23, $this->source); })()), "date", [], "any", false, false, false, 23)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["evenment"]) || array_key_exists("evenment", $context) ? $context["evenment"] : (function () { throw new RuntimeError('Variable "evenment" does not exist.', 23, $this->source); })()), "date", [], "any", false, false, false, 23), "d/m/Y"), "html", null, true)) : (""));
        yield "</td>
                    </tr>
                    <tr>
                        <th>Lieu</th>
                        <td>";
        // line 27
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["evenment"]) || array_key_exists("evenment", $context) ? $context["evenment"] : (function () { throw new RuntimeError('Variable "evenment" does not exist.', 27, $this->source); })()), "lieu", [], "any", false, false, false, 27), "html", null, true);
        yield "</td>
                    </tr>
                    <tr>
                        <th>Catégorie</th>
                        <td>";
        // line 31
        yield ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["evenment"]) || array_key_exists("evenment", $context) ? $context["evenment"] : (function () { throw new RuntimeError('Variable "evenment" does not exist.', 31, $this->source); })()), "idCategorie", [], "any", false, false, false, 31)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["evenment"]) || array_key_exists("evenment", $context) ? $context["evenment"] : (function () { throw new RuntimeError('Variable "evenment" does not exist.', 31, $this->source); })()), "idCategorie", [], "any", false, false, false, 31), "nom", [], "any", false, false, false, 31), "html", null, true)) : (""));
        yield "</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class=\"mt-3\">
        <a href=\"";
        // line 39
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_evenment_index");
        yield "\" class=\"btn btn-secondary\">
            <i class=\"fas fa-arrow-left\"></i> Retour à la liste
        </a>
        <a href=\"";
        // line 42
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_evenment_edit", ["id_event" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["evenment"]) || array_key_exists("evenment", $context) ? $context["evenment"] : (function () { throw new RuntimeError('Variable "evenment" does not exist.', 42, $this->source); })()), "id_event", [], "any", false, false, false, 42)]), "html", null, true);
        yield "\" class=\"btn btn-primary\">
            <i class=\"fas fa-edit\"></i> Modifier
        </a>
    </div>
</div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "evenment/show.html.twig";
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
        return array (  157 => 42,  151 => 39,  140 => 31,  133 => 27,  126 => 23,  119 => 19,  112 => 15,  101 => 6,  88 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'back_base.html.twig' %}

{% block title %}Détails de l'Événement #{{ evenment.id_event }}{% endblock %}

{% block body %}
<div class=\"container mt-4\">
    <h1 class=\"mb-4\">Détails de l'événement</h1>

    <div class=\"card\">
        <div class=\"card-body\">
            <table class=\"table\">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <td>{{ evenment.id_event }}</td>
                    </tr>
                    <tr>
                        <th>Nom</th>
                        <td>{{ evenment.nom }}</td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td>{{ evenment.date ? evenment.date|date('d/m/Y') : '' }}</td>
                    </tr>
                    <tr>
                        <th>Lieu</th>
                        <td>{{ evenment.lieu }}</td>
                    </tr>
                    <tr>
                        <th>Catégorie</th>
                        <td>{{ evenment.idCategorie ? evenment.idCategorie.nom : '' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class=\"mt-3\">
        <a href=\"{{ path('app_evenment_index') }}\" class=\"btn btn-secondary\">
            <i class=\"fas fa-arrow-left\"></i> Retour à la liste
        </a>
        <a href=\"{{ path('app_evenment_edit', {'id_event': evenment.id_event}) }}\" class=\"btn btn-primary\">
            <i class=\"fas fa-edit\"></i> Modifier
        </a>
    </div>
</div>
{% endblock %}", "evenment/show.html.twig", "C:\\Users\\user\\Desktop\\symfonyfareszakrawicrud\\hamhama\\templates\\evenment\\show.html.twig");
    }
}
