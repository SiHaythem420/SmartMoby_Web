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

/* front/account_settings.html.twig */
class __TwigTemplate_13f5f14a178ab2e85a6dd7a1c34f9a25 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/account_settings.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "front/account_settings.html.twig"));

        // line 1
        yield "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>Document</title>
    <link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css\">
    <link rel = \"stylesheet\" href =\"";
        // line 8
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("css/account_settings.css"), "html", null, true);
        yield "\">
</head>
<body>
    <link href=\"https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css\" rel=\"stylesheet\" />

<div class=\"container p-0\">
    <h1 class=\"h3 mb-3\">Paramétres</h1>
    <div class=\"row\">
        <div class=\"col-md-5 col-xl-4\">

            <div class=\"card\">
                <div class=\"card-header\">
                    <h5 class=\"card-title mb-0\">Paramétres De Compte</h5>
                </div>

                <div class=\"list-group list-group-flush\" role=\"tablist\">
                    <a class=\"list-group-item list-group-item-action active\" data-toggle=\"list\" href=\"#account\" role=\"tab\">
                      Compte
                    </a>
                    <a class=\"list-group-item list-group-item-action\" data-toggle=\"list\" href=\"#password\" role=\"tab\">
                      Mot De Passe
                    </a>
                    <a class=\"list-group-item list-group-item-action\" data-toggle=\"list\" href=\"#supprimer\" role=\"tab\">
                      Supprimer le Compte
                    </a>
                </div>
            </div>
        </div>

        <div class=\"col-md-7 col-xl-8\">
            <div class=\"tab-content\">
                <div class=\"tab-pane fade show active\" id=\"account\" role=\"tabpanel\">

                    

                    <div class=\"card\">
                        <div class=\"card-header\">
                            <div class=\"card-actions float-right\">
                                <div class=\"dropdown show\">
                                    <a href=\"#\" data-toggle=\"dropdown\" data-display=\"static\">
                                        <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"feather feather-more-horizontal align-middle\">
                                            <circle cx=\"12\" cy=\"12\" r=\"1\"></circle>
                                            <circle cx=\"19\" cy=\"12\" r=\"1\"></circle>
                                            <circle cx=\"5\" cy=\"12\" r=\"1\"></circle>
                                        </svg>
                                    </a>

                                    <div class=\"dropdown-menu dropdown-menu-right\">
                                        <a class=\"dropdown-item\" href=\"#\">Action</a>
                                        <a class=\"dropdown-item\" href=\"#\">Another action</a>
                                        <a class=\"dropdown-item\" href=\"#\">Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <h5 class=\"card-title mb-0\">Private info</h5>
                        </div>
                        <div class=\"card-body\">
                            <form>
                                <div class=\"form-row\">
                                    <div class=\"form-group col-md-6\">
                                        <label for=\"inputFirstName\">First name</label>
                                        <input type=\"text\" class=\"form-control\" id=\"inputFirstName\" placeholder=\"First name\">
                                    </div>
                                    <div class=\"form-group col-md-6\">
                                        <label for=\"inputLastName\">Last name</label>
                                        <input type=\"text\" class=\"form-control\" id=\"inputLastName\" placeholder=\"Last name\">
                                    </div>
                                </div>
                                <div class=\"form-group\">
                                    <label for=\"inputEmail4\">Email</label>
                                    <input type=\"email\" class=\"form-control\" id=\"inputEmail4\" placeholder=\"Email\">
                                </div>
                                <div class=\"form-group\">
                                    <label for=\"inputAddress\">Address</label>
                                    <input type=\"text\" class=\"form-control\" id=\"inputAddress\" placeholder=\"1234 Main St\">
                                </div>
                                <div class=\"form-group\">
                                    <label for=\"inputAddress2\">Address 2</label>
                                    <input type=\"text\" class=\"form-control\" id=\"inputAddress2\" placeholder=\"Apartment, studio, or floor\">
                                </div>
                                <div class=\"form-row\">
                                    <div class=\"form-group col-md-6\">
                                        <label for=\"inputCity\">City</label>
                                        <input type=\"text\" class=\"form-control\" id=\"inputCity\">
                                    </div>
                                    <div class=\"form-group col-md-4\">
                                        <label for=\"inputState\">State</label>
                                        <select id=\"inputState\" class=\"form-control\">
                                            <option selected=\"\">Choose...</option>
                                            <option>...</option>
                                        </select>
                                    </div>
                                    <div class=\"form-group col-md-2\">
                                        <label for=\"inputZip\">Zip</label>
                                        <input type=\"text\" class=\"form-control\" id=\"inputZip\">
                                    </div>
                                </div>
                                <button type=\"submit\" class=\"btn btn-primary\">Save changes</button>
                            </form>

                        </div>
                    </div>

                </div>
                <div class=\"tab-pane fade\" id=\"password\" role=\"tabpanel\">
                    <div class=\"card\">
                        <div class=\"card-body\">
                            <h5 class=\"card-title\">Password</h5>

                            <form>
                                <div class=\"form-group\">
                                    <label for=\"inputPasswordCurrent\">Current password</label>
                                    <input type=\"password\" class=\"form-control\" id=\"inputPasswordCurrent\">
                                    <small><a href=\"#\">Forgot your password?</a></small>
                                </div>
                                <div class=\"form-group\">
                                    <label for=\"inputPasswordNew\">New password</label>
                                    <input type=\"password\" class=\"form-control\" id=\"inputPasswordNew\">
                                </div>
                                <div class=\"form-group\">
                                    <label for=\"inputPasswordNew2\">Verify password</label>
                                    <input type=\"password\" class=\"form-control\" id=\"inputPasswordNew2\">
                                </div>
                                <button type=\"submit\" class=\"btn btn-primary\">Save changes</button>
                            </form>

                        </div>
                    </div>
                </div>
                <div class=\"tab-pane fade\" id=\"supprimer\" role=\"tabpanel\">
                    <div class=\"card\">
                        <div class=\"card-body\">
                            <h5 class=\"card-title\">Supprimer Le Compte</h5>
                            <p class=\"card-text\">Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.</p>
                            <form method=\"post\" action=\"";
        // line 142
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_account_settings");
        yield "\">
                                <button type=\"submit\" class=\"btn btn-danger\">Supprimer</button>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src=\"https://code.jquery.com/jquery-3.3.1.slim.min.js\"></script>
<script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js\"></script>
<script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js\"></script>
    
</body>
</html>";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "front/account_settings.html.twig";
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
        return array (  194 => 142,  57 => 8,  48 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>Document</title>
    <link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css\">
    <link rel = \"stylesheet\" href =\"{{ asset('css/account_settings.css')}}\">
</head>
<body>
    <link href=\"https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css\" rel=\"stylesheet\" />

<div class=\"container p-0\">
    <h1 class=\"h3 mb-3\">Paramétres</h1>
    <div class=\"row\">
        <div class=\"col-md-5 col-xl-4\">

            <div class=\"card\">
                <div class=\"card-header\">
                    <h5 class=\"card-title mb-0\">Paramétres De Compte</h5>
                </div>

                <div class=\"list-group list-group-flush\" role=\"tablist\">
                    <a class=\"list-group-item list-group-item-action active\" data-toggle=\"list\" href=\"#account\" role=\"tab\">
                      Compte
                    </a>
                    <a class=\"list-group-item list-group-item-action\" data-toggle=\"list\" href=\"#password\" role=\"tab\">
                      Mot De Passe
                    </a>
                    <a class=\"list-group-item list-group-item-action\" data-toggle=\"list\" href=\"#supprimer\" role=\"tab\">
                      Supprimer le Compte
                    </a>
                </div>
            </div>
        </div>

        <div class=\"col-md-7 col-xl-8\">
            <div class=\"tab-content\">
                <div class=\"tab-pane fade show active\" id=\"account\" role=\"tabpanel\">

                    

                    <div class=\"card\">
                        <div class=\"card-header\">
                            <div class=\"card-actions float-right\">
                                <div class=\"dropdown show\">
                                    <a href=\"#\" data-toggle=\"dropdown\" data-display=\"static\">
                                        <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"feather feather-more-horizontal align-middle\">
                                            <circle cx=\"12\" cy=\"12\" r=\"1\"></circle>
                                            <circle cx=\"19\" cy=\"12\" r=\"1\"></circle>
                                            <circle cx=\"5\" cy=\"12\" r=\"1\"></circle>
                                        </svg>
                                    </a>

                                    <div class=\"dropdown-menu dropdown-menu-right\">
                                        <a class=\"dropdown-item\" href=\"#\">Action</a>
                                        <a class=\"dropdown-item\" href=\"#\">Another action</a>
                                        <a class=\"dropdown-item\" href=\"#\">Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <h5 class=\"card-title mb-0\">Private info</h5>
                        </div>
                        <div class=\"card-body\">
                            <form>
                                <div class=\"form-row\">
                                    <div class=\"form-group col-md-6\">
                                        <label for=\"inputFirstName\">First name</label>
                                        <input type=\"text\" class=\"form-control\" id=\"inputFirstName\" placeholder=\"First name\">
                                    </div>
                                    <div class=\"form-group col-md-6\">
                                        <label for=\"inputLastName\">Last name</label>
                                        <input type=\"text\" class=\"form-control\" id=\"inputLastName\" placeholder=\"Last name\">
                                    </div>
                                </div>
                                <div class=\"form-group\">
                                    <label for=\"inputEmail4\">Email</label>
                                    <input type=\"email\" class=\"form-control\" id=\"inputEmail4\" placeholder=\"Email\">
                                </div>
                                <div class=\"form-group\">
                                    <label for=\"inputAddress\">Address</label>
                                    <input type=\"text\" class=\"form-control\" id=\"inputAddress\" placeholder=\"1234 Main St\">
                                </div>
                                <div class=\"form-group\">
                                    <label for=\"inputAddress2\">Address 2</label>
                                    <input type=\"text\" class=\"form-control\" id=\"inputAddress2\" placeholder=\"Apartment, studio, or floor\">
                                </div>
                                <div class=\"form-row\">
                                    <div class=\"form-group col-md-6\">
                                        <label for=\"inputCity\">City</label>
                                        <input type=\"text\" class=\"form-control\" id=\"inputCity\">
                                    </div>
                                    <div class=\"form-group col-md-4\">
                                        <label for=\"inputState\">State</label>
                                        <select id=\"inputState\" class=\"form-control\">
                                            <option selected=\"\">Choose...</option>
                                            <option>...</option>
                                        </select>
                                    </div>
                                    <div class=\"form-group col-md-2\">
                                        <label for=\"inputZip\">Zip</label>
                                        <input type=\"text\" class=\"form-control\" id=\"inputZip\">
                                    </div>
                                </div>
                                <button type=\"submit\" class=\"btn btn-primary\">Save changes</button>
                            </form>

                        </div>
                    </div>

                </div>
                <div class=\"tab-pane fade\" id=\"password\" role=\"tabpanel\">
                    <div class=\"card\">
                        <div class=\"card-body\">
                            <h5 class=\"card-title\">Password</h5>

                            <form>
                                <div class=\"form-group\">
                                    <label for=\"inputPasswordCurrent\">Current password</label>
                                    <input type=\"password\" class=\"form-control\" id=\"inputPasswordCurrent\">
                                    <small><a href=\"#\">Forgot your password?</a></small>
                                </div>
                                <div class=\"form-group\">
                                    <label for=\"inputPasswordNew\">New password</label>
                                    <input type=\"password\" class=\"form-control\" id=\"inputPasswordNew\">
                                </div>
                                <div class=\"form-group\">
                                    <label for=\"inputPasswordNew2\">Verify password</label>
                                    <input type=\"password\" class=\"form-control\" id=\"inputPasswordNew2\">
                                </div>
                                <button type=\"submit\" class=\"btn btn-primary\">Save changes</button>
                            </form>

                        </div>
                    </div>
                </div>
                <div class=\"tab-pane fade\" id=\"supprimer\" role=\"tabpanel\">
                    <div class=\"card\">
                        <div class=\"card-body\">
                            <h5 class=\"card-title\">Supprimer Le Compte</h5>
                            <p class=\"card-text\">Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.</p>
                            <form method=\"post\" action=\"{{path('app_account_settings')}}\">
                                <button type=\"submit\" class=\"btn btn-danger\">Supprimer</button>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src=\"https://code.jquery.com/jquery-3.3.1.slim.min.js\"></script>
<script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js\"></script>
<script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js\"></script>
    
</body>
</html>", "front/account_settings.html.twig", "C:\\Users\\user\\Desktop\\symfonyfareszakrawicrud\\hamhama\\templates\\front\\account_settings.html.twig");
    }
}
