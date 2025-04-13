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

/* front/login.html.twig */
class __TwigTemplate_b4405dc246b97893e4ed223022755ca1 extends Template
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
            'css' => [$this, 'block_css'],
            'js' => [$this, 'block_js'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/login.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/login.html.twig"));

        // line 1
        yield "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>Document</title>
\t";
        // line 7
        yield from $this->unwrap()->yieldBlock('css', $context, $blocks);
        // line 10
        yield "</head>
<body>
    
<div class=\"container\" id=\"container\">
\t<div class=\"form-container sign-up-container\">
\t\t<form action=\"";
        // line 15
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_inscription");
        yield "\" method=\"post\">
    \t\t<h1>Créer Un Compte</h1>
    \t\t";
        // line 17
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 17, $this->source); })()), 'form_start');
        yield "
        \t\t";
        // line 18
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 18, $this->source); })()), "nom", [], "any", false, false, false, 18), 'widget', ["attr" => ["placeholder" => "Nom", "class" => "form-input"]]);
        yield " 
        \t\t<div class=\"form-error\">
        \t\t\t";
        // line 20
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 20, $this->source); })()), "nom", [], "any", false, false, false, 20), 'errors');
        yield "
    \t\t\t</div>
\t\t\t\t";
        // line 22
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 22, $this->source); })()), "prenom", [], "any", false, false, false, 22), 'widget', ["label" => false, "attr" => ["placeholder" => "Prénom", "class" => "form-input"]]);
        yield "
\t\t\t\t<div class=\"form-error\">
        \t\t\t";
        // line 24
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 24, $this->source); })()), "prenom", [], "any", false, false, false, 24), 'errors');
        yield "
    \t\t\t</div>
\t\t\t\t";
        // line 26
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 26, $this->source); })()), "nom_utilisateur", [], "any", false, false, false, 26), 'widget', ["label" => false, "attr" => ["placeholder" => "Nom d'utilisateur", "class" => "form-input"]]);
        yield "
\t\t\t\t<div class=\"form-error\">
        \t\t\t";
        // line 28
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 28, $this->source); })()), "nom_utilisateur", [], "any", false, false, false, 28), 'errors');
        yield "
    \t\t\t</div>
        \t\t";
        // line 30
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 30, $this->source); })()), "email", [], "any", false, false, false, 30), 'widget', ["label" => false, "attr" => ["placeholder" => "Email", "class" => "form-input"]]);
        yield "
\t\t\t\t<div class=\"form-error\">
        \t\t\t";
        // line 32
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 32, $this->source); })()), "email", [], "any", false, false, false, 32), 'errors');
        yield "
    \t\t\t</div>
        \t\t";
        // line 34
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 34, $this->source); })()), "mot_de_passe", [], "any", false, false, false, 34), 'widget', ["label" => false, "attr" => ["placeholder" => "Mot De Passe", "class" => "form-input"]]);
        yield "
\t\t\t\t<div class=\"form-error\">
        \t\t\t";
        // line 36
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 36, $this->source); })()), "mot_de_passe", [], "any", false, false, false, 36), 'errors');
        yield "
    \t\t\t</div>
        \t\t";
        // line 38
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 38, $this->source); })()), "role", [], "any", false, false, false, 38), 'widget', ["label" => false, "attr" => ["id" => "utilisateur_role", "onchange" => "handleRoleChange()", "class" => "form-input"]]);
        yield "
\t\t\t\t<div class=\"form-error\">
        \t\t\t";
        // line 40
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 40, $this->source); })()), "role", [], "any", false, false, false, 40), 'errors');
        yield "
    \t\t\t</div>
\t\t\t
        \t\t
        \t\t<button class=\"button-inscrire\">S'inscrire</button>
    \t\t";
        // line 45
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 45, $this->source); })()), 'form_end');
        yield "
\t\t</form>
\t</div>
\t<div class=\"form-container sign-in-container\">
\t\t<form action=\"";
        // line 49
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_inscription");
        yield "\" method=\"POST\">
    \t\t<h1>Se Connecter</h1>
    \t\t<input type=\"email\" name=\"email\" placeholder=\"Email\" required />
    \t\t<input type=\"password\" name=\"mot_de_passe\" placeholder=\"Mot De Passe\" required />
    \t\t<a href=\"#\">Mot De Passe Oublié ?</a>
    \t\t<button type=\"submit\">Se Connecter</button>
<\t\t</form>
\t</div>
\t<div class=\"overlay-container\">
\t\t<div class=\"overlay\">
\t\t\t<div class=\"overlay-panel overlay-left\">
\t\t\t\t<h1>Bonjour !</h1>
\t\t\t\t<p>Entrez vos informations personnelles et commencez l'aventure ! </p>
\t\t\t\t<button class=\"ghost\" id=\"signIn\">Se Connecter ?</button>
\t\t\t</div>
\t\t\t<div class=\"overlay-panel overlay-right\">
\t\t\t\t<h1>Content De Vous Revoir !</h1>
\t\t\t\t<p>Pour rester connecté avec nous, veuillez vous connecter avec vos informations personnelles</p>
\t\t\t\t<button class=\"ghost\" id=\"signUp\">S'inscrire ?</button>
\t\t\t</div>
\t\t</div>
\t</div>
</div>

";
        // line 73
        yield from $this->unwrap()->yieldBlock('js', $context, $blocks);
        // line 76
        yield "</body>
</html>";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 7
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_css(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "css"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "css"));

        // line 8
        yield "\t<link rel=\"stylesheet\" href=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("css/login.css"), "html", null, true);
        yield "\">
\t";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 73
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_js(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "js"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "js"));

        // line 74
        yield "<script src=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/login.js"), "html", null, true);
        yield "\"></script>
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
        return "front/login.html.twig";
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
        return array (  227 => 74,  214 => 73,  200 => 8,  187 => 7,  175 => 76,  173 => 73,  146 => 49,  139 => 45,  131 => 40,  126 => 38,  121 => 36,  116 => 34,  111 => 32,  106 => 30,  101 => 28,  96 => 26,  91 => 24,  86 => 22,  81 => 20,  76 => 18,  72 => 17,  67 => 15,  60 => 10,  58 => 7,  50 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>Document</title>
\t{% block css %}
\t<link rel=\"stylesheet\" href=\"{{ asset('css/login.css') }}\">
\t{% endblock %}
</head>
<body>
    
<div class=\"container\" id=\"container\">
\t<div class=\"form-container sign-up-container\">
\t\t<form action=\"{{ path('app_inscription') }}\" method=\"post\">
    \t\t<h1>Créer Un Compte</h1>
    \t\t{{ form_start(form) }}
        \t\t{{ form_widget(form.nom, {'attr': {'placeholder': 'Nom', 'class': 'form-input'}}) }} 
        \t\t<div class=\"form-error\">
        \t\t\t{{ form_errors(form.nom) }}
    \t\t\t</div>
\t\t\t\t{{ form_widget (form.prenom, {'label': false ,'attr': {'placeholder': 'Prénom', 'class': 'form-input'}}) }}
\t\t\t\t<div class=\"form-error\">
        \t\t\t{{ form_errors(form.prenom) }}
    \t\t\t</div>
\t\t\t\t{{ form_widget (form.nom_utilisateur, {'label': false, 'attr': {'placeholder': \"Nom d'utilisateur\", 'class': 'form-input'}}) }}
\t\t\t\t<div class=\"form-error\">
        \t\t\t{{ form_errors(form.nom_utilisateur) }}
    \t\t\t</div>
        \t\t{{ form_widget (form.email , {'label': false, 'attr': {'placeholder': \"Email\", 'class': 'form-input'}}) }}
\t\t\t\t<div class=\"form-error\">
        \t\t\t{{ form_errors(form.email) }}
    \t\t\t</div>
        \t\t{{ form_widget (form.mot_de_passe , {'label': false, 'attr': {'placeholder': \"Mot De Passe\", 'class': 'form-input'}}) }}
\t\t\t\t<div class=\"form-error\">
        \t\t\t{{ form_errors(form.mot_de_passe) }}
    \t\t\t</div>
        \t\t{{ form_widget (form.role, {'label': false, 'attr': {'id': 'utilisateur_role', 'onchange': 'handleRoleChange()', 'class': 'form-input'}}) }}
\t\t\t\t<div class=\"form-error\">
        \t\t\t{{ form_errors(form.role) }}
    \t\t\t</div>
\t\t\t
        \t\t
        \t\t<button class=\"button-inscrire\">S'inscrire</button>
    \t\t{{ form_end(form) }}
\t\t</form>
\t</div>
\t<div class=\"form-container sign-in-container\">
\t\t<form action=\"{{ path('app_inscription') }}\" method=\"POST\">
    \t\t<h1>Se Connecter</h1>
    \t\t<input type=\"email\" name=\"email\" placeholder=\"Email\" required />
    \t\t<input type=\"password\" name=\"mot_de_passe\" placeholder=\"Mot De Passe\" required />
    \t\t<a href=\"#\">Mot De Passe Oublié ?</a>
    \t\t<button type=\"submit\">Se Connecter</button>
<\t\t</form>
\t</div>
\t<div class=\"overlay-container\">
\t\t<div class=\"overlay\">
\t\t\t<div class=\"overlay-panel overlay-left\">
\t\t\t\t<h1>Bonjour !</h1>
\t\t\t\t<p>Entrez vos informations personnelles et commencez l'aventure ! </p>
\t\t\t\t<button class=\"ghost\" id=\"signIn\">Se Connecter ?</button>
\t\t\t</div>
\t\t\t<div class=\"overlay-panel overlay-right\">
\t\t\t\t<h1>Content De Vous Revoir !</h1>
\t\t\t\t<p>Pour rester connecté avec nous, veuillez vous connecter avec vos informations personnelles</p>
\t\t\t\t<button class=\"ghost\" id=\"signUp\">S'inscrire ?</button>
\t\t\t</div>
\t\t</div>
\t</div>
</div>

{% block js %}
<script src=\"{{ asset('js/login.js') }}\"></script>
{% endblock %}
</body>
</html>", "front/login.html.twig", "C:\\Users\\user\\Desktop\\symfonyfareszakrawicrud\\hamhama\\templates\\front\\login.html.twig");
    }
}
