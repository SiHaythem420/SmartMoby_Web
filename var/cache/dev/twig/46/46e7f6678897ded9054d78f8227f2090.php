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

/* evenment/edit.html.twig */
class __TwigTemplate_58399c9fba241f5207777536c897f9eb extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "evenment/edit.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "evenment/edit.html.twig"));

        $this->parent = $this->loadTemplate("back_base.html.twig", "evenment/edit.html.twig", 1);
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

        yield "Modifier l'Événement #";
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
    <h1 class=\"mb-4\">Modifier l'événement</h1>

    <div class=\"card\">
        <div class=\"card-body\">
            ";
        // line 11
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 11, $this->source); })()), 'form_start', ["attr" => ["novalidate" => "novalidate", "data-turbo" => "false"]]);
        // line 16
        yield "
            
                ";
        // line 19
        yield "                <div class=\"form-group mb-3\">
                    ";
        // line 20
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 20, $this->source); })()), "nom", [], "any", false, false, false, 20), 'label', ["label_attr" => ["class" => "form-label"]]);
        // line 22
        yield "
                    ";
        // line 23
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 23, $this->source); })()), "nom", [], "any", false, false, false, 23), 'widget', ["attr" => ["class" => ("form-control" . ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,         // line 25
(isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 25, $this->source); })()), "nom", [], "any", false, false, false, 25), "vars", [], "any", false, false, false, 25), "errors", [], "any", false, false, false, 25))) ? (" is-invalid") : (""))), "placeholder" => "Entrez le nom de l'événement"]]);
        // line 28
        yield "
                    ";
        // line 29
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 29, $this->source); })()), "nom", [], "any", false, false, false, 29), 'errors', ["attr" => ["class" => "invalid-feedback"]]);
        // line 31
        yield "
                </div>

                ";
        // line 35
        yield "                <div class=\"form-group mb-3\">
                    ";
        // line 36
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 36, $this->source); })()), "date", [], "any", false, false, false, 36), 'label', ["label_attr" => ["class" => "form-label"]]);
        // line 38
        yield "
                    ";
        // line 39
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 39, $this->source); })()), "date", [], "any", false, false, false, 39), 'widget', ["attr" => ["class" => ("form-control datepicker" . ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,         // line 41
(isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 41, $this->source); })()), "date", [], "any", false, false, false, 41), "vars", [], "any", false, false, false, 41), "errors", [], "any", false, false, false, 41))) ? (" is-invalid") : ("")))]]);
        // line 43
        yield "
                    ";
        // line 44
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 44, $this->source); })()), "date", [], "any", false, false, false, 44), 'errors', ["attr" => ["class" => "invalid-feedback"]]);
        // line 46
        yield "
                </div>

                ";
        // line 50
        yield "                <div class=\"form-group mb-3\">
                    ";
        // line 51
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 51, $this->source); })()), "lieu", [], "any", false, false, false, 51), 'label', ["label_attr" => ["class" => "form-label"]]);
        // line 53
        yield "
                    ";
        // line 54
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 54, $this->source); })()), "lieu", [], "any", false, false, false, 54), 'widget', ["attr" => ["class" => ("form-control" . ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,         // line 56
(isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 56, $this->source); })()), "lieu", [], "any", false, false, false, 56), "vars", [], "any", false, false, false, 56), "errors", [], "any", false, false, false, 56))) ? (" is-invalid") : (""))), "placeholder" => "Entrez le lieu de l'événement"]]);
        // line 59
        yield "
                    ";
        // line 60
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 60, $this->source); })()), "lieu", [], "any", false, false, false, 60), 'errors', ["attr" => ["class" => "invalid-feedback"]]);
        // line 62
        yield "
                </div>

                ";
        // line 66
        yield "                <div class=\"form-group mb-4\">
                    ";
        // line 67
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 67, $this->source); })()), "id_categorie", [], "any", false, false, false, 67), 'label', ["label_attr" => ["class" => "form-label"]]);
        // line 69
        yield "
                    ";
        // line 70
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 70, $this->source); })()), "id_categorie", [], "any", false, false, false, 70), 'widget', ["attr" => ["class" => ("form-control" . ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,         // line 72
(isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 72, $this->source); })()), "id_categorie", [], "any", false, false, false, 72), "vars", [], "any", false, false, false, 72), "errors", [], "any", false, false, false, 72))) ? (" is-invalid") : ("")))]]);
        // line 74
        yield "
                    ";
        // line 75
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 75, $this->source); })()), "id_categorie", [], "any", false, false, false, 75), 'errors', ["attr" => ["class" => "invalid-feedback"]]);
        // line 77
        yield "
                </div>

                <div class=\"form-group mt-3\">
                    <button type=\"submit\" class=\"btn btn-primary\">
                        <i class=\"fas fa-save me-2\"></i>Mettre à jour
                    </button>
                    <a href=\"";
        // line 84
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_evenment_index");
        yield "\" class=\"btn btn-secondary\">
                        <i class=\"fas fa-arrow-left me-2\"></i>Retour à la liste
                    </a>
                </div>
            ";
        // line 88
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 88, $this->source); })()), 'form_end');
        yield "
        </div>
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
        return "evenment/edit.html.twig";
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
        return array (  209 => 88,  202 => 84,  193 => 77,  191 => 75,  188 => 74,  186 => 72,  185 => 70,  182 => 69,  180 => 67,  177 => 66,  172 => 62,  170 => 60,  167 => 59,  165 => 56,  164 => 54,  161 => 53,  159 => 51,  156 => 50,  151 => 46,  149 => 44,  146 => 43,  144 => 41,  143 => 39,  140 => 38,  138 => 36,  135 => 35,  130 => 31,  128 => 29,  125 => 28,  123 => 25,  122 => 23,  119 => 22,  117 => 20,  114 => 19,  110 => 16,  108 => 11,  101 => 6,  88 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'back_base.html.twig' %}

{% block title %}Modifier l'Événement #{{ evenment.id_event }}{% endblock %}

{% block body %}
<div class=\"container mt-4\">
    <h1 class=\"mb-4\">Modifier l'événement</h1>

    <div class=\"card\">
        <div class=\"card-body\">
            {{ form_start(form, {
                'attr': {
                    'novalidate': 'novalidate',
                    'data-turbo': 'false'
                }
            }) }}
            
                {# Champ Nom #}
                <div class=\"form-group mb-3\">
                    {{ form_label(form.nom, null, {
                        'label_attr': {'class': 'form-label'}
                    }) }}
                    {{ form_widget(form.nom, {
                        'attr': {
                            'class': 'form-control' ~ (form.nom.vars.errors|length ? ' is-invalid' : ''),
                            'placeholder': 'Entrez le nom de l\\'événement'
                        }
                    }) }}
                    {{ form_errors(form.nom, {
                        'attr': {'class': 'invalid-feedback'}
                    }) }}
                </div>

                {# Champ Date #}
                <div class=\"form-group mb-3\">
                    {{ form_label(form.date, null, {
                        'label_attr': {'class': 'form-label'}
                    }) }}
                    {{ form_widget(form.date, {
                        'attr': {
                            'class': 'form-control datepicker' ~ (form.date.vars.errors|length ? ' is-invalid' : ''),
                        }
                    }) }}
                    {{ form_errors(form.date, {
                        'attr': {'class': 'invalid-feedback'}
                    }) }}
                </div>

                {# Champ Lieu #}
                <div class=\"form-group mb-3\">
                    {{ form_label(form.lieu, null, {
                        'label_attr': {'class': 'form-label'}
                    }) }}
                    {{ form_widget(form.lieu, {
                        'attr': {
                            'class': 'form-control' ~ (form.lieu.vars.errors|length ? ' is-invalid' : ''),
                            'placeholder': 'Entrez le lieu de l\\'événement'
                        }
                    }) }}
                    {{ form_errors(form.lieu, {
                        'attr': {'class': 'invalid-feedback'}
                    }) }}
                </div>

                {# Champ Catégorie #}
                <div class=\"form-group mb-4\">
                    {{ form_label(form.id_categorie, null, {
                        'label_attr': {'class': 'form-label'}
                    }) }}
                    {{ form_widget(form.id_categorie, {
                        'attr': {
                            'class': 'form-control' ~ (form.id_categorie.vars.errors|length ? ' is-invalid' : '')
                        }
                    }) }}
                    {{ form_errors(form.id_categorie, {
                        'attr': {'class': 'invalid-feedback'}
                    }) }}
                </div>

                <div class=\"form-group mt-3\">
                    <button type=\"submit\" class=\"btn btn-primary\">
                        <i class=\"fas fa-save me-2\"></i>Mettre à jour
                    </button>
                    <a href=\"{{ path('app_evenment_index') }}\" class=\"btn btn-secondary\">
                        <i class=\"fas fa-arrow-left me-2\"></i>Retour à la liste
                    </a>
                </div>
            {{ form_end(form) }}
        </div>
    </div>
</div>
{% endblock %}", "evenment/edit.html.twig", "C:\\Users\\user\\Desktop\\symfonyfareszakrawicrud\\hamhama\\templates\\evenment\\edit.html.twig");
    }
}
