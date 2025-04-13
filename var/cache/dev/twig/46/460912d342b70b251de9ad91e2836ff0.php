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

/* categorie/_form.html.twig */
class __TwigTemplate_5878b458600e15b2f87a9cc209846006 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "categorie/_form.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "categorie/_form.html.twig"));

        // line 1
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 1, $this->source); })()), 'form_start', ["attr" => ["novalidate" => "novalidate", "data-turbo" => "false"]]);
        // line 6
        yield "
    <div class=\"card\">
        <div class=\"card-body\">
            ";
        // line 10
        yield "            <div class=\"form-group mb-3\">
                ";
        // line 11
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 11, $this->source); })()), "nom", [], "any", false, false, false, 11), 'label', ["label_attr" => ["class" => "form-label"], "label" => "Nom de la catégorie"]);
        // line 13
        yield "
                ";
        // line 14
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 14, $this->source); })()), "nom", [], "any", false, false, false, 14), 'widget', ["attr" => ["class" => ("form-control" . ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,         // line 16
(isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 16, $this->source); })()), "nom", [], "any", false, false, false, 16), "vars", [], "any", false, false, false, 16), "errors", [], "any", false, false, false, 16))) ? (" is-invalid") : (""))), "autocomplete" => "off"]]);
        // line 19
        yield "
                ";
        // line 20
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 20, $this->source); })()), "nom", [], "any", false, false, false, 20), 'errors', ["attr" => ["class" => "invalid-feedback"]]);
        // line 22
        yield "
            </div>

            ";
        // line 26
        yield "            <div class=\"form-group mb-4\">
                ";
        // line 27
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 27, $this->source); })()), "description", [], "any", false, false, false, 27), 'label', ["label_attr" => ["class" => "form-label"], "label" => "Description"]);
        // line 29
        yield "
                ";
        // line 30
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 30, $this->source); })()), "description", [], "any", false, false, false, 30), 'widget', ["attr" => ["class" => ("form-control" . ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,         // line 32
(isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 32, $this->source); })()), "description", [], "any", false, false, false, 32), "vars", [], "any", false, false, false, 32), "errors", [], "any", false, false, false, 32))) ? (" is-invalid") : (""))), "rows" => 3, "autocomplete" => "off"]]);
        // line 36
        yield "
                ";
        // line 37
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 37, $this->source); })()), "description", [], "any", false, false, false, 37), 'errors', ["attr" => ["class" => "invalid-feedback"]]);
        // line 39
        yield "
            </div>

            ";
        // line 43
        yield "            <button type=\"submit\" class=\"btn btn-primary\">
                <i class=\"fas fa-save me-2\"></i>";
        // line 44
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("button_label", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["button_label"]) || array_key_exists("button_label", $context) ? $context["button_label"] : (function () { throw new RuntimeError('Variable "button_label" does not exist.', 44, $this->source); })()), "Enregistrer")) : ("Enregistrer")), "html", null, true);
        yield "
            </button>
        </div>
    </div>
";
        // line 48
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 48, $this->source); })()), 'form_end');
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "categorie/_form.html.twig";
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
        return array (  107 => 48,  100 => 44,  97 => 43,  92 => 39,  90 => 37,  87 => 36,  85 => 32,  84 => 30,  81 => 29,  79 => 27,  76 => 26,  71 => 22,  69 => 20,  66 => 19,  64 => 16,  63 => 14,  60 => 13,  58 => 11,  55 => 10,  50 => 6,  48 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{{ form_start(form, {
    'attr': {
        'novalidate': 'novalidate',
        'data-turbo': 'false'
    }
}) }}
    <div class=\"card\">
        <div class=\"card-body\">
            {# Champ Nom avec gestion d'erreur #}
            <div class=\"form-group mb-3\">
                {{ form_label(form.nom, 'Nom de la catégorie', {
                    'label_attr': {'class': 'form-label'}
                }) }}
                {{ form_widget(form.nom, {
                    'attr': {
                        'class': 'form-control' ~ (form.nom.vars.errors|length ? ' is-invalid' : ''),
                        'autocomplete': 'off'
                    }
                }) }}
                {{ form_errors(form.nom, {
                    'attr': {'class': 'invalid-feedback'}
                }) }}
            </div>

            {# Champ Description avec gestion d'erreur #}
            <div class=\"form-group mb-4\">
                {{ form_label(form.description, 'Description', {
                    'label_attr': {'class': 'form-label'}
                }) }}
                {{ form_widget(form.description, {
                    'attr': {
                        'class': 'form-control' ~ (form.description.vars.errors|length ? ' is-invalid' : ''),
                        'rows': 3,
                        'autocomplete': 'off'
                    }
                }) }}
                {{ form_errors(form.description, {
                    'attr': {'class': 'invalid-feedback'}
                }) }}
            </div>

            {# Bouton de soumission #}
            <button type=\"submit\" class=\"btn btn-primary\">
                <i class=\"fas fa-save me-2\"></i>{{ button_label|default('Enregistrer') }}
            </button>
        </div>
    </div>
{{ form_end(form) }}", "categorie/_form.html.twig", "C:\\Users\\user\\Desktop\\symfonyfareszakrawicrud\\hamhama\\templates\\categorie\\_form.html.twig");
    }
}
