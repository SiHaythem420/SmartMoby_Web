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

/* evenment/index.html.twig */
class __TwigTemplate_1ee6f0e0ec717e85425f500e71691cce extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "evenment/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "evenment/index.html.twig"));

        $this->parent = $this->loadTemplate("back_base.html.twig", "evenment/index.html.twig", 1);
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

        yield "Liste des Événements";
        
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
    <h1 class=\"mb-4\">Liste des Événements</h1>

    <div class=\"mb-3\">
        <a href=\"";
        // line 10
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_evenment_new");
        yield "\" class=\"btn btn-primary\">
            <i class=\"fas fa-plus\"></i> Créer un nouvel événement
        </a>
    </div>

    <div class=\"table-responsive\">
        <table class=\"table table-striped table-hover\">
            <thead class=\"thead-dark\">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Date</th>
                    <th>Lieu</th>
                    <th>Catégorie</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            ";
        // line 28
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["evenments"]) || array_key_exists("evenments", $context) ? $context["evenments"] : (function () { throw new RuntimeError('Variable "evenments" does not exist.', 28, $this->source); })()));
        $context['_iterated'] = false;
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["evenment"]) {
            // line 29
            yield "                <tr>
                    <td>";
            // line 30
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["evenment"], "id_event", [], "any", false, false, false, 30), "html", null, true);
            yield "</td>
                    <td>";
            // line 31
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["evenment"], "nom", [], "any", false, false, false, 31), "html", null, true);
            yield "</td>
                    <td>";
            // line 32
            yield ((CoreExtension::getAttribute($this->env, $this->source, $context["evenment"], "date", [], "any", false, false, false, 32)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["evenment"], "date", [], "any", false, false, false, 32), "d/m/Y"), "html", null, true)) : (""));
            yield "</td>
                    <td>";
            // line 33
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["evenment"], "lieu", [], "any", false, false, false, 33), "html", null, true);
            yield "</td>
                    <td>";
            // line 34
            yield ((CoreExtension::getAttribute($this->env, $this->source, $context["evenment"], "id_categorie", [], "any", false, false, false, 34)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["evenment"], "id_categorie", [], "any", false, false, false, 34), "nom", [], "any", false, false, false, 34), "html", null, true)) : (""));
            yield "</td>
                    <td>
                        <div class=\"btn-group\" role=\"group\">
                            <a href=\"";
            // line 37
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_evenment_show", ["id_event" => CoreExtension::getAttribute($this->env, $this->source, $context["evenment"], "id_event", [], "any", false, false, false, 37)]), "html", null, true);
            yield "\" 
                               class=\"btn btn-sm btn-info\">
                                <i class=\"fas fa-eye\"></i>
                            </a>
                            <a href=\"";
            // line 41
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_evenment_edit", ["id_event" => CoreExtension::getAttribute($this->env, $this->source, $context["evenment"], "id_event", [], "any", false, false, false, 41)]), "html", null, true);
            yield "\" 
                               class=\"btn btn-sm btn-warning\">
                                <i class=\"fas fa-edit\"></i>
                            </a>
<div class=\"btn-group\" role=\"group\">
    ";
            // line 47
            yield "    ";
            yield Twig\Extension\CoreExtension::include($this->env, $context, "evenment/_delete_form.html.twig");
            yield "
</div>                        </div>
                    </td>
                </tr>
            ";
            $context['_iterated'] = true;
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        // line 51
        if (!$context['_iterated']) {
            // line 52
            yield "                <tr>
                    <td colspan=\"6\" class=\"text-center\">Aucun événement trouvé</td>
                </tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['evenment'], $context['_parent'], $context['_iterated'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 56
        yield "            </tbody>
        </table>
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
        return "evenment/index.html.twig";
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
        return array (  214 => 56,  205 => 52,  203 => 51,  185 => 47,  177 => 41,  170 => 37,  164 => 34,  160 => 33,  156 => 32,  152 => 31,  148 => 30,  145 => 29,  127 => 28,  106 => 10,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'back_base.html.twig' %}

{% block title %}Liste des Événements{% endblock %}

{% block body %}
<div class=\"container mt-4\">
    <h1 class=\"mb-4\">Liste des Événements</h1>

    <div class=\"mb-3\">
        <a href=\"{{ path('app_evenment_new') }}\" class=\"btn btn-primary\">
            <i class=\"fas fa-plus\"></i> Créer un nouvel événement
        </a>
    </div>

    <div class=\"table-responsive\">
        <table class=\"table table-striped table-hover\">
            <thead class=\"thead-dark\">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Date</th>
                    <th>Lieu</th>
                    <th>Catégorie</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {% for evenment in evenments %}
                <tr>
                    <td>{{ evenment.id_event }}</td>
                    <td>{{ evenment.nom }}</td>
                    <td>{{ evenment.date ? evenment.date|date('d/m/Y') : '' }}</td>
                    <td>{{ evenment.lieu }}</td>
                    <td>{{ evenment.id_categorie ? evenment.id_categorie.nom : '' }}</td>
                    <td>
                        <div class=\"btn-group\" role=\"group\">
                            <a href=\"{{ path('app_evenment_show', {'id_event': evenment.id_event}) }}\" 
                               class=\"btn btn-sm btn-info\">
                                <i class=\"fas fa-eye\"></i>
                            </a>
                            <a href=\"{{ path('app_evenment_edit', {'id_event': evenment.id_event}) }}\" 
                               class=\"btn btn-sm btn-warning\">
                                <i class=\"fas fa-edit\"></i>
                            </a>
<div class=\"btn-group\" role=\"group\">
    {# ... autres boutons ... #}
    {{ include('evenment/_delete_form.html.twig') }}
</div>                        </div>
                    </td>
                </tr>
            {% else %}
                <tr>
                    <td colspan=\"6\" class=\"text-center\">Aucun événement trouvé</td>
                </tr>
            {% endfor %}
            </tbody>
        </table>
    </div>
</div>
{% endblock %}", "evenment/index.html.twig", "C:\\Users\\user\\Desktop\\symfonyfareszakrawicrud\\hamhama\\templates\\evenment\\index.html.twig");
    }
}
