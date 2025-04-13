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

/* base.html.twig */
class __TwigTemplate_fe6a33cf2ea68e993d136ecf41ee8298 extends Template
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
            'title' => [$this, 'block_title'],
            'css' => [$this, 'block_css'],
            'header' => [$this, 'block_header'],
            'content' => [$this, 'block_content'],
            'footer' => [$this, 'block_footer'],
            'js' => [$this, 'block_js'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "base.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "base.html.twig"));

        // line 1
        yield "<!DOCTYPE html>
<html lang=\"en\">

<head>
    <title>";
        // line 5
        yield from $this->unwrap()->yieldBlock('title', $context, $blocks);
        yield " </title>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">

    ";
        // line 9
        yield from $this->unwrap()->yieldBlock('css', $context, $blocks);
        // line 22
        yield "    <!--

    
TemplateMo 559 Zay Shop

https://templatemo.com/tm-559-zay-shop

-->
</head>

<body>
    

    ";
        // line 35
        yield from $this->unwrap()->yieldBlock('header', $context, $blocks);
        // line 97
        yield "    <!-- Close Header -->

    <!-- Modal -->
    ";
        // line 100
        yield from $this->unwrap()->yieldBlock('content', $context, $blocks);
        // line 388
        yield "

    <!-- Start Footer -->
     ";
        // line 391
        yield from $this->unwrap()->yieldBlock('footer', $context, $blocks);
        // line 437
        yield "    <!-- End Footer -->

    ";
        // line 439
        yield from $this->unwrap()->yieldBlock('js', $context, $blocks);
        // line 451
        yield "    <!-- End Script -->
</body>

</html>";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 5
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

        yield " Zay Shop eCommerce HTML CSS Template ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 9
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

        // line 10
        yield "    <link rel=\"apple-touch-icon\" href=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/apple-icon.png"), "html", null, true);
        yield "\">
    <link rel=\"shortcut icon\" type=\"image/x-icon\" href=\"";
        // line 11
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/favicon.ico"), "html", null, true);
        yield "\">

    <link rel=\"stylesheet\" href=\"";
        // line 13
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("css/bootstrap.min.css"), "html", null, true);
        yield "\">
    <link rel=\"stylesheet\" href=\"";
        // line 14
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("css/templatemo.css"), "html", null, true);
        yield "\">
    <link rel=\"stylesheet\" href=\"";
        // line 15
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("css/custom.css"), "html", null, true);
        yield "\">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel=\"stylesheet\" href=\"https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap\">
    <link rel=\"stylesheet\" href=\"";
        // line 19
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("css/fontawesome.min.css"), "html", null, true);
        yield "\">
    <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css\">
    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 35
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_header(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "header"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "header"));

        // line 36
        yield "    <!-- Header -->
    <nav class=\"navbar navbar-expand-lg navbar-light shadow\">
        <div class=\"container d-flex justify-content-between align-items-center\">

            <a class=\"navbar-brand text-success logo h1 align-self-center\" href=\"index.html\">
                SMART MOBY
            </a>

            <button class=\"navbar-toggler border-0\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#templatemo_main_nav\" aria-controls=\"navbarSupportedContent\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
                <span class=\"navbar-toggler-icon\"></span>
            </button>

            <div class=\"align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between\" id=\"templatemo_main_nav\">
                <div class=\"flex-fill\">
                    <ul class=\"nav navbar-nav d-flex justify-content-between mx-lg-auto\">
                        <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"\">Acceuil</a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"about.html\">Services </a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"shop.html\">Trajet Du Trafic </a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"contact.html\">Evenements</a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"contact.html\">Blog</a>
                        </li>
                    </ul>
                </div>
                <div class=\"navbar align-self-center d-flex\">
                    <div class=\"d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3\">
                        <div class=\"input-group\">
                            <input type=\"text\" class=\"form-control\" id=\"inputMobileSearch\" placeholder=\"Search ...\">
                            <div class=\"input-group-text\">
                                <i class=\"fa fa-fw fa-search\"></i>
                            </div>
                        </div>
                    </div>
                    <a class=\"nav-icon d-none d-lg-inline\" href=\"#\" data-bs-toggle=\"modal\" data-bs-target=\"#templatemo_search\">
                        <i class=\"fa fa-fw fa-search text-dark mr-2\"></i>
                    </a>
                    
                    <div class=\"dropdown\">
                        <a class=\"nav-icon position-relative text-decoration-none dropdown-toggle\" href=\"#\" id=\"userDropdown\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
                                <i class=\"fa fa-fw fa-user text-dark mr-3\"></i>
                                
                        </a>
                        <ul class=\"dropdown-menu dropdown-menu-end\" aria-labelledby=\"userDropdown\">
                            <li><a class=\"dropdown-item\" href=\"\">Paramètres</a></li>
                            <li><a class=\"dropdown-item\" href=\"\">Se Déconnecter</a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </nav>
    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 100
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        // line 101
        yield "    <div class=\"modal fade bg-white\" id=\"templatemo_search\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\" >
        <div class=\"modal-dialog modal-lg\" role=\"document\">
            <div class=\"w-100 pt-1 mb-5 text-right\">
                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
            </div>
            <form action=\"\" method=\"get\" class=\"modal-content modal-body border-0 p-0\">
                <div class=\"input-group mb-2\">
                    <input type=\"text\" class=\"form-control\" id=\"inputModalSearch\" name=\"q\" placeholder=\"Search ...\">
                    <button type=\"submit\" class=\"input-group-text bg-success text-light\">
                        <i class=\"fa fa-fw fa-search text-white\"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>



    <!-- Start Banner Hero -->
    <div id=\"template-mo-zay-hero-carousel\" class=\"carousel slide\" data-bs-ride=\"carousel\">
        
        <div class=\"carousel-inner\">
            <div class=\"carousel-item active\">
                <div class=\"container\">
                    <div class=\"row p-5\">
                        <div class=\"mx-auto col-md-8 col-lg-6 order-lg-last\">
                            <img class=\"img-fluid image-animation\" src=\"";
        // line 127
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/LOGO_pi.png"), "html", null, true);
        yield "\" alt=\"\">
                        </div>
                        <div class=\"col-lg-6 mb-0 d-flex align-items-center\">
                            <div class=\"text-align-left align-self-center\">
                                <h1 class=\"h1 text-success\"><b>Smart Moby</b> La Mobilité Intelligente</h1>
                                <h3 class=\"h2\">Réinventer la mobilité pour un avenir plus intelligent !</h3>
                                <p>
                                    Bienvenue sur Smart Moby, votre partenaire pour une mobilité moderne, connectée et durable. Simplifiez vos déplacements dès aujourd'hui ! 
                                    
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
        
        
    </div>
    <!-- End Banner Hero -->


    <!-- Start Oussema -->
    <section class=\"container py-5\" data-aos=\"fade-left\">
        <div class=\"row text-center pt-3\">
            <div class=\"col-lg-6 m-auto\">
                <h1 class=\"h1\">Evenements Du Mois</h1>
                <p>
                    Oussema houni shy7ot l events mte3 l shhar hedhik
                </p>
            </div>
        </div>
        <div class=\"row\">
            <div class=\"col-12 col-md-4 p-5 mt-3\">
                <a href=\"#\"><img src=\"";
        // line 162
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/category_img_01.jpg"), "html", null, true);
        yield "\" class=\"rounded-circle img-fluid border\"></a>
                <h5 class=\"text-center mt-3 mb-3\">Watches</h5>
                <p class=\"text-center\"><a class=\"btn btn-success\">Go Shop</a></p>
            </div>
            <div class=\"col-12 col-md-4 p-5 mt-3\">
                <a href=\"#\"><img src=\"";
        // line 167
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/category_img_02.jpg"), "html", null, true);
        yield "\" class=\"rounded-circle img-fluid border\"></a>
                <h2 class=\"h5 text-center mt-3 mb-3\">Shoes</h2>
                <p class=\"text-center\"><a class=\"btn btn-success\">Go Shop</a></p>
            </div>
            <div class=\"col-12 col-md-4 p-5 mt-3\">
                <a href=\"#\"><img src=\"";
        // line 172
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/category_img_03.jpg"), "html", null, true);
        yield "\" class=\"rounded-circle img-fluid border\"></a>
                <h2 class=\"h5 text-center mt-3 mb-3\">Accessories</h2>
                <p class=\"text-center\"><a class=\"btn btn-success\">Go Shop</a></p>
            </div>
        </div>
    </section>
    <!-- End Oussema -->


    <!-- Start Fares -->
    <section class=\"bg-light\" data-aos=\"fade-right\">
        <div class=\"container py-5\">
            <div class=\"row text-center py-3\">
                <div class=\"col-lg-6 m-auto\">
                    <h1 class=\"h1\">Services En Vedettte</h1>
                    <p>
                        Fares houni shy7ot shwaya servicet 
                    </p>
                </div>
            </div>
            <div class=\"row\">
                <div class=\"col-12 col-md-4 mb-4\">
                    <div class=\"card h-100\">
                        <a href=\"shop-single.html\">
                            <img src=\"";
        // line 196
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/feature_prod_01.jpg"), "html", null, true);
        yield "\" class=\"card-img-top\" alt=\"...\">
                        </a>
                        <div class=\"card-body\">
                            <ul class=\"list-unstyled d-flex justify-content-between\">
                                <li>
                                    <i class=\"text-warning fa fa-star\"></i>
                                    <i class=\"text-warning fa fa-star\"></i>
                                    <i class=\"text-warning fa fa-star\"></i>
                                    <i class=\"text-muted fa fa-star\"></i>
                                    <i class=\"text-muted fa fa-star\"></i>
                                </li>
                                <li class=\"text-muted text-right\">\$240.00</li>
                            </ul>
                            <a href=\"shop-single.html\" class=\"h2 text-decoration-none text-dark\">Gym Weight</a>
                            <p class=\"card-text\">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt in culpa qui officia deserunt.
                            </p>
                            <p class=\"text-muted\">Reviews (24)</p>
                        </div>
                    </div>
                </div>
                <div class=\"col-12 col-md-4 mb-4\">
                    <div class=\"card h-100\">
                        <a href=\"shop-single.html\">
                            <img src=\"";
        // line 220
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/feature_prod_02.jpg"), "html", null, true);
        yield "\" class=\"card-img-top\" alt=\"...\">
                        </a>
                        <div class=\"card-body\">
                            <ul class=\"list-unstyled d-flex justify-content-between\">
                                <li>
                                    <i class=\"text-warning fa fa-star\"></i>
                                    <i class=\"text-warning fa fa-star\"></i>
                                    <i class=\"text-warning fa fa-star\"></i>
                                    <i class=\"text-muted fa fa-star\"></i>
                                    <i class=\"text-muted fa fa-star\"></i>
                                </li>
                                <li class=\"text-muted text-right\">\$480.00</li>
                            </ul>
                            <a href=\"shop-single.html\" class=\"h2 text-decoration-none text-dark\">Cloud Nike Shoes</a>
                            <p class=\"card-text\">
                                Aenean gravida dignissim finibus. Nullam ipsum diam, posuere vitae pharetra sed, commodo ullamcorper.
                            </p>
                            <p class=\"text-muted\">Reviews (48)</p>
                        </div>
                    </div>
                </div>
                <div class=\"col-12 col-md-4 mb-4\">
                    <div class=\"card h-100\">
                        <a href=\"shop-single.html\">
                            <img src=\"";
        // line 244
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/feature_prod_03.jpg"), "html", null, true);
        yield "\" class=\"card-img-top\" alt=\"...\">
                        </a>
                        <div class=\"card-body\">
                            <ul class=\"list-unstyled d-flex justify-content-between\">
                                <li>
                                    <i class=\"text-warning fa fa-star\"></i>
                                    <i class=\"text-warning fa fa-star\"></i>
                                    <i class=\"text-warning fa fa-star\"></i>
                                    <i class=\"text-warning fa fa-star\"></i>
                                    <i class=\"text-warning fa fa-star\"></i>
                                </li>
                                <li class=\"text-muted text-right\">\$360.00</li>
                            </ul>
                            <a href=\"shop-single.html\" class=\"h2 text-decoration-none text-dark\">Summer Addides Shoes</a>
                            <p class=\"card-text\">
                                Curabitur ac mi sit amet diam luctus porta. Phasellus pulvinar sagittis diam, et scelerisque ipsum lobortis nec.
                            </p>
                            <p class=\"text-muted\">Reviews (74)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Fares -->

    <!-- Start Hedi Feed -->
    <section style=\"background-color: #f8f9fa;\" data-aos=\"fade-left\">
        <div class=\"container py-5\">
            <div class=\"row text-center py-3\">
                <div class=\"col-lg-6 m-auto\">
                    <h1 class=\"h1\">Trajets En Vedettte</h1>
                    <p>
                        Hedi houni shy7ot shwaya trajeyet 
                    </p>
                </div>
            </div>
            <div class=\"row\">
                <div class=\"col-12 col-md-4 mb-4\">
                    <div class=\"card h-100\">
                        <a href=\"shop-single.html\">
                            <img src=\"";
        // line 285
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/feature_prod_01.jpg"), "html", null, true);
        yield "\" class=\"card-img-top\" alt=\"...\">
                        </a>
                        <div class=\"card-body\">
                            <ul class=\"list-unstyled d-flex justify-content-between\">
                                <li>
                                    <i class=\"text-warning fa fa-star\"></i>
                                    <i class=\"text-warning fa fa-star\"></i>
                                    <i class=\"text-warning fa fa-star\"></i>
                                    <i class=\"text-muted fa fa-star\"></i>
                                    <i class=\"text-muted fa fa-star\"></i>
                                </li>
                                <li class=\"text-muted text-right\">\$240.00</li>
                            </ul>
                            <a href=\"shop-single.html\" class=\"h2 text-decoration-none text-dark\">Gym Weight</a>
                            <p class=\"card-text\">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt in culpa qui officia deserunt.
                            </p>
                            <p class=\"text-muted\">Reviews (24)</p>
                        </div>
                    </div>
                </div>
                <div class=\"col-12 col-md-4 mb-4\">
                    <div class=\"card h-100\">
                        <a href=\"shop-single.html\">
                            <img src=\"";
        // line 309
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/feature_prod_02.jpg"), "html", null, true);
        yield "\" class=\"card-img-top\" alt=\"...\">
                        </a>
                        <div class=\"card-body\">
                            <ul class=\"list-unstyled d-flex justify-content-between\">
                                <li>
                                    <i class=\"text-warning fa fa-star\"></i>
                                    <i class=\"text-warning fa fa-star\"></i>
                                    <i class=\"text-warning fa fa-star\"></i>
                                    <i class=\"text-muted fa fa-star\"></i>
                                    <i class=\"text-muted fa fa-star\"></i>
                                </li>
                                <li class=\"text-muted text-right\">\$480.00</li>
                            </ul>
                            <a href=\"shop-single.html\" class=\"h2 text-decoration-none text-dark\">Cloud Nike Shoes</a>
                            <p class=\"card-text\">
                                Aenean gravida dignissim finibus. Nullam ipsum diam, posuere vitae pharetra sed, commodo ullamcorper.
                            </p>
                            <p class=\"text-muted\">Reviews (48)</p>
                        </div>
                    </div>
                </div>
                <div class=\"col-12 col-md-4 mb-4\">
                    <div class=\"card h-100\">
                        <a href=\"shop-single.html\">
                            <img src=\"";
        // line 333
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/feature_prod_03.jpg"), "html", null, true);
        yield "\" class=\"card-img-top\" alt=\"...\">
                        </a>
                        <div class=\"card-body\">
                            <ul class=\"list-unstyled d-flex justify-content-between\">
                                <li>
                                    <i class=\"text-warning fa fa-star\"></i>
                                    <i class=\"text-warning fa fa-star\"></i>
                                    <i class=\"text-warning fa fa-star\"></i>
                                    <i class=\"text-warning fa fa-star\"></i>
                                    <i class=\"text-warning fa fa-star\"></i>
                                </li>
                                <li class=\"text-muted text-right\">\$360.00</li>
                            </ul>
                            <a href=\"shop-single.html\" class=\"h2 text-decoration-none text-dark\">Summer Addides Shoes</a>
                            <p class=\"card-text\">
                                Curabitur ac mi sit amet diam luctus porta. Phasellus pulvinar sagittis diam, et scelerisque ipsum lobortis nec.
                            </p>
                            <p class=\"text-muted\">Reviews (74)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- End Hedi Feed -->

    <!-- Start Hazem -->
    <div id=\"template-mo-zay-hero-carousel\" class=\"carousel slide\" data-bs-ride=\"carousel\" data-aos=\"fade-right\">
        
        <div class=\"carousel-inner\">
            <div class=\"carousel-item active\">
                <div class=\"container\">
                    <div class=\"row p-5\">
                        <div class=\"mx-auto col-md-8 col-lg-6 order-lg-last\">
                            <img class=\"img-fluid\" src=\"";
        // line 368
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/avis.png"), "html", null, true);
        yield "\" alt=\"\">
                        </div>
                        <div class=\"col-lg-6 mb-0 d-flex align-items-center justify-content-center\">
                            <div class=\"text-center\">
                                <a class=\"nav-link\" href=\"\" style=\"color: inherit;\" onmouseover=\"this.children[0].style.color='#28a745';\" onmouseout=\"this.children[0].style.color='#808080';\">
                                    <h1 ><b>Laissez Un Avis ?</b></h1>
                                </a>
                                <h3 class=\"h2\">Accédez au blog et partagez vos avis !</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
        
        
    </div>
    <!-- End Hazem -->
    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 391
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_footer(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "footer"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "footer"));

        // line 392
        yield "    <footer class=\"bg-dark\" id=\"tempaltemo_footer\">
        <div class=\"container\">
            <div class=\"row\">

                <div class=\"col-md-4 pt-5\">
                    <h2 class=\"h2 text-success border-bottom pb-3 border-light logo\">Smart Moby</h2>
                    <ul class=\"list-unstyled text-light footer-link-list\">
                        <li>
                            <i class=\"fas fa-map-marker-alt fa-fw\"></i>
                            Cité El Ghazela, Ariana, Tunis
                        </li>
                        <li>
                            <i class=\"fa fa-phone fa-fw\"></i>
                            <a class=\"text-decoration-none\" >+216 98 444 555</a>
                        </li>
                        <li>
                            <i class=\"fa fa-envelope fa-fw\"></i>
                            <a class=\"text-decoration-none\" >info@smart_moby.com</a>
                        </li>
                    </ul>
                </div>

                

            </div>

            
                
        </div>

        <div class=\"w-100 bg-black py-3\">
            <div class=\"container\">
                <div class=\"row pt-2\">
                    <div class=\"col-12\">
                        <p class=\"text-left text-light\">
                            Copyright &copy; 2025 Smart Moby Co., Ltd.
                            
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </footer>
    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 439
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

        // line 440
        yield "    <!-- Start Script -->
    <script src=\"";
        // line 441
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/jquery-1.11.0.min.js"), "html", null, true);
        yield "\"></script>
    <script src=\"";
        // line 442
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/jquery-migrate-1.2.1.min.js"), "html", null, true);
        yield "\"></script>
    <script src=\"";
        // line 443
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/bootstrap.bundle.min.js"), "html", null, true);
        yield "\"></script>
    <script src=\"";
        // line 444
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/templatemo.js"), "html", null, true);
        yield "\"></script>
    <script src=\"";
        // line 445
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("js/custom.js"), "html", null, true);
        yield "\"></script>
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js\"></script>
    <script>
        AOS.init(); // Initialise AOS
    </script>
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
        return "base.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  722 => 445,  718 => 444,  714 => 443,  710 => 442,  706 => 441,  703 => 440,  690 => 439,  635 => 392,  622 => 391,  591 => 368,  553 => 333,  526 => 309,  499 => 285,  455 => 244,  428 => 220,  401 => 196,  374 => 172,  366 => 167,  358 => 162,  320 => 127,  292 => 101,  279 => 100,  208 => 36,  195 => 35,  181 => 19,  174 => 15,  170 => 14,  166 => 13,  161 => 11,  156 => 10,  143 => 9,  120 => 5,  106 => 451,  104 => 439,  100 => 437,  98 => 391,  93 => 388,  91 => 100,  86 => 97,  84 => 35,  69 => 22,  67 => 9,  60 => 5,  54 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"en\">

<head>
    <title>{% block title %} Zay Shop eCommerce HTML CSS Template {% endblock %} </title>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">

    {% block css %}
    <link rel=\"apple-touch-icon\" href=\"{{asset('img/apple-icon.png')}}\">
    <link rel=\"shortcut icon\" type=\"image/x-icon\" href=\"{{asset('img/favicon.ico')}}\">

    <link rel=\"stylesheet\" href=\"{{asset('css/bootstrap.min.css')}}\">
    <link rel=\"stylesheet\" href=\"{{asset('css/templatemo.css')}}\">
    <link rel=\"stylesheet\" href=\"{{asset('css/custom.css')}}\">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel=\"stylesheet\" href=\"https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap\">
    <link rel=\"stylesheet\" href=\"{{asset('css/fontawesome.min.css')}}\">
    <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css\">
    {% endblock %}
    <!--

    
TemplateMo 559 Zay Shop

https://templatemo.com/tm-559-zay-shop

-->
</head>

<body>
    

    {% block header %}
    <!-- Header -->
    <nav class=\"navbar navbar-expand-lg navbar-light shadow\">
        <div class=\"container d-flex justify-content-between align-items-center\">

            <a class=\"navbar-brand text-success logo h1 align-self-center\" href=\"index.html\">
                SMART MOBY
            </a>

            <button class=\"navbar-toggler border-0\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#templatemo_main_nav\" aria-controls=\"navbarSupportedContent\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
                <span class=\"navbar-toggler-icon\"></span>
            </button>

            <div class=\"align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between\" id=\"templatemo_main_nav\">
                <div class=\"flex-fill\">
                    <ul class=\"nav navbar-nav d-flex justify-content-between mx-lg-auto\">
                        <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"\">Acceuil</a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"about.html\">Services </a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"shop.html\">Trajet Du Trafic </a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"contact.html\">Evenements</a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"contact.html\">Blog</a>
                        </li>
                    </ul>
                </div>
                <div class=\"navbar align-self-center d-flex\">
                    <div class=\"d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3\">
                        <div class=\"input-group\">
                            <input type=\"text\" class=\"form-control\" id=\"inputMobileSearch\" placeholder=\"Search ...\">
                            <div class=\"input-group-text\">
                                <i class=\"fa fa-fw fa-search\"></i>
                            </div>
                        </div>
                    </div>
                    <a class=\"nav-icon d-none d-lg-inline\" href=\"#\" data-bs-toggle=\"modal\" data-bs-target=\"#templatemo_search\">
                        <i class=\"fa fa-fw fa-search text-dark mr-2\"></i>
                    </a>
                    
                    <div class=\"dropdown\">
                        <a class=\"nav-icon position-relative text-decoration-none dropdown-toggle\" href=\"#\" id=\"userDropdown\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
                                <i class=\"fa fa-fw fa-user text-dark mr-3\"></i>
                                
                        </a>
                        <ul class=\"dropdown-menu dropdown-menu-end\" aria-labelledby=\"userDropdown\">
                            <li><a class=\"dropdown-item\" href=\"\">Paramètres</a></li>
                            <li><a class=\"dropdown-item\" href=\"\">Se Déconnecter</a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </nav>
    {% endblock %}
    <!-- Close Header -->

    <!-- Modal -->
    {% block content %}
    <div class=\"modal fade bg-white\" id=\"templatemo_search\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\" >
        <div class=\"modal-dialog modal-lg\" role=\"document\">
            <div class=\"w-100 pt-1 mb-5 text-right\">
                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
            </div>
            <form action=\"\" method=\"get\" class=\"modal-content modal-body border-0 p-0\">
                <div class=\"input-group mb-2\">
                    <input type=\"text\" class=\"form-control\" id=\"inputModalSearch\" name=\"q\" placeholder=\"Search ...\">
                    <button type=\"submit\" class=\"input-group-text bg-success text-light\">
                        <i class=\"fa fa-fw fa-search text-white\"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>



    <!-- Start Banner Hero -->
    <div id=\"template-mo-zay-hero-carousel\" class=\"carousel slide\" data-bs-ride=\"carousel\">
        
        <div class=\"carousel-inner\">
            <div class=\"carousel-item active\">
                <div class=\"container\">
                    <div class=\"row p-5\">
                        <div class=\"mx-auto col-md-8 col-lg-6 order-lg-last\">
                            <img class=\"img-fluid image-animation\" src=\"{{asset('img/LOGO_pi.png')}}\" alt=\"\">
                        </div>
                        <div class=\"col-lg-6 mb-0 d-flex align-items-center\">
                            <div class=\"text-align-left align-self-center\">
                                <h1 class=\"h1 text-success\"><b>Smart Moby</b> La Mobilité Intelligente</h1>
                                <h3 class=\"h2\">Réinventer la mobilité pour un avenir plus intelligent !</h3>
                                <p>
                                    Bienvenue sur Smart Moby, votre partenaire pour une mobilité moderne, connectée et durable. Simplifiez vos déplacements dès aujourd'hui ! 
                                    
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
        
        
    </div>
    <!-- End Banner Hero -->


    <!-- Start Oussema -->
    <section class=\"container py-5\" data-aos=\"fade-left\">
        <div class=\"row text-center pt-3\">
            <div class=\"col-lg-6 m-auto\">
                <h1 class=\"h1\">Evenements Du Mois</h1>
                <p>
                    Oussema houni shy7ot l events mte3 l shhar hedhik
                </p>
            </div>
        </div>
        <div class=\"row\">
            <div class=\"col-12 col-md-4 p-5 mt-3\">
                <a href=\"#\"><img src=\"{{asset('img/category_img_01.jpg')}}\" class=\"rounded-circle img-fluid border\"></a>
                <h5 class=\"text-center mt-3 mb-3\">Watches</h5>
                <p class=\"text-center\"><a class=\"btn btn-success\">Go Shop</a></p>
            </div>
            <div class=\"col-12 col-md-4 p-5 mt-3\">
                <a href=\"#\"><img src=\"{{asset('img/category_img_02.jpg')}}\" class=\"rounded-circle img-fluid border\"></a>
                <h2 class=\"h5 text-center mt-3 mb-3\">Shoes</h2>
                <p class=\"text-center\"><a class=\"btn btn-success\">Go Shop</a></p>
            </div>
            <div class=\"col-12 col-md-4 p-5 mt-3\">
                <a href=\"#\"><img src=\"{{asset('img/category_img_03.jpg')}}\" class=\"rounded-circle img-fluid border\"></a>
                <h2 class=\"h5 text-center mt-3 mb-3\">Accessories</h2>
                <p class=\"text-center\"><a class=\"btn btn-success\">Go Shop</a></p>
            </div>
        </div>
    </section>
    <!-- End Oussema -->


    <!-- Start Fares -->
    <section class=\"bg-light\" data-aos=\"fade-right\">
        <div class=\"container py-5\">
            <div class=\"row text-center py-3\">
                <div class=\"col-lg-6 m-auto\">
                    <h1 class=\"h1\">Services En Vedettte</h1>
                    <p>
                        Fares houni shy7ot shwaya servicet 
                    </p>
                </div>
            </div>
            <div class=\"row\">
                <div class=\"col-12 col-md-4 mb-4\">
                    <div class=\"card h-100\">
                        <a href=\"shop-single.html\">
                            <img src=\"{{asset('img/feature_prod_01.jpg')}}\" class=\"card-img-top\" alt=\"...\">
                        </a>
                        <div class=\"card-body\">
                            <ul class=\"list-unstyled d-flex justify-content-between\">
                                <li>
                                    <i class=\"text-warning fa fa-star\"></i>
                                    <i class=\"text-warning fa fa-star\"></i>
                                    <i class=\"text-warning fa fa-star\"></i>
                                    <i class=\"text-muted fa fa-star\"></i>
                                    <i class=\"text-muted fa fa-star\"></i>
                                </li>
                                <li class=\"text-muted text-right\">\$240.00</li>
                            </ul>
                            <a href=\"shop-single.html\" class=\"h2 text-decoration-none text-dark\">Gym Weight</a>
                            <p class=\"card-text\">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt in culpa qui officia deserunt.
                            </p>
                            <p class=\"text-muted\">Reviews (24)</p>
                        </div>
                    </div>
                </div>
                <div class=\"col-12 col-md-4 mb-4\">
                    <div class=\"card h-100\">
                        <a href=\"shop-single.html\">
                            <img src=\"{{asset('img/feature_prod_02.jpg')}}\" class=\"card-img-top\" alt=\"...\">
                        </a>
                        <div class=\"card-body\">
                            <ul class=\"list-unstyled d-flex justify-content-between\">
                                <li>
                                    <i class=\"text-warning fa fa-star\"></i>
                                    <i class=\"text-warning fa fa-star\"></i>
                                    <i class=\"text-warning fa fa-star\"></i>
                                    <i class=\"text-muted fa fa-star\"></i>
                                    <i class=\"text-muted fa fa-star\"></i>
                                </li>
                                <li class=\"text-muted text-right\">\$480.00</li>
                            </ul>
                            <a href=\"shop-single.html\" class=\"h2 text-decoration-none text-dark\">Cloud Nike Shoes</a>
                            <p class=\"card-text\">
                                Aenean gravida dignissim finibus. Nullam ipsum diam, posuere vitae pharetra sed, commodo ullamcorper.
                            </p>
                            <p class=\"text-muted\">Reviews (48)</p>
                        </div>
                    </div>
                </div>
                <div class=\"col-12 col-md-4 mb-4\">
                    <div class=\"card h-100\">
                        <a href=\"shop-single.html\">
                            <img src=\"{{asset('img/feature_prod_03.jpg')}}\" class=\"card-img-top\" alt=\"...\">
                        </a>
                        <div class=\"card-body\">
                            <ul class=\"list-unstyled d-flex justify-content-between\">
                                <li>
                                    <i class=\"text-warning fa fa-star\"></i>
                                    <i class=\"text-warning fa fa-star\"></i>
                                    <i class=\"text-warning fa fa-star\"></i>
                                    <i class=\"text-warning fa fa-star\"></i>
                                    <i class=\"text-warning fa fa-star\"></i>
                                </li>
                                <li class=\"text-muted text-right\">\$360.00</li>
                            </ul>
                            <a href=\"shop-single.html\" class=\"h2 text-decoration-none text-dark\">Summer Addides Shoes</a>
                            <p class=\"card-text\">
                                Curabitur ac mi sit amet diam luctus porta. Phasellus pulvinar sagittis diam, et scelerisque ipsum lobortis nec.
                            </p>
                            <p class=\"text-muted\">Reviews (74)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Fares -->

    <!-- Start Hedi Feed -->
    <section style=\"background-color: #f8f9fa;\" data-aos=\"fade-left\">
        <div class=\"container py-5\">
            <div class=\"row text-center py-3\">
                <div class=\"col-lg-6 m-auto\">
                    <h1 class=\"h1\">Trajets En Vedettte</h1>
                    <p>
                        Hedi houni shy7ot shwaya trajeyet 
                    </p>
                </div>
            </div>
            <div class=\"row\">
                <div class=\"col-12 col-md-4 mb-4\">
                    <div class=\"card h-100\">
                        <a href=\"shop-single.html\">
                            <img src=\"{{asset('img/feature_prod_01.jpg')}}\" class=\"card-img-top\" alt=\"...\">
                        </a>
                        <div class=\"card-body\">
                            <ul class=\"list-unstyled d-flex justify-content-between\">
                                <li>
                                    <i class=\"text-warning fa fa-star\"></i>
                                    <i class=\"text-warning fa fa-star\"></i>
                                    <i class=\"text-warning fa fa-star\"></i>
                                    <i class=\"text-muted fa fa-star\"></i>
                                    <i class=\"text-muted fa fa-star\"></i>
                                </li>
                                <li class=\"text-muted text-right\">\$240.00</li>
                            </ul>
                            <a href=\"shop-single.html\" class=\"h2 text-decoration-none text-dark\">Gym Weight</a>
                            <p class=\"card-text\">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt in culpa qui officia deserunt.
                            </p>
                            <p class=\"text-muted\">Reviews (24)</p>
                        </div>
                    </div>
                </div>
                <div class=\"col-12 col-md-4 mb-4\">
                    <div class=\"card h-100\">
                        <a href=\"shop-single.html\">
                            <img src=\"{{asset('img/feature_prod_02.jpg')}}\" class=\"card-img-top\" alt=\"...\">
                        </a>
                        <div class=\"card-body\">
                            <ul class=\"list-unstyled d-flex justify-content-between\">
                                <li>
                                    <i class=\"text-warning fa fa-star\"></i>
                                    <i class=\"text-warning fa fa-star\"></i>
                                    <i class=\"text-warning fa fa-star\"></i>
                                    <i class=\"text-muted fa fa-star\"></i>
                                    <i class=\"text-muted fa fa-star\"></i>
                                </li>
                                <li class=\"text-muted text-right\">\$480.00</li>
                            </ul>
                            <a href=\"shop-single.html\" class=\"h2 text-decoration-none text-dark\">Cloud Nike Shoes</a>
                            <p class=\"card-text\">
                                Aenean gravida dignissim finibus. Nullam ipsum diam, posuere vitae pharetra sed, commodo ullamcorper.
                            </p>
                            <p class=\"text-muted\">Reviews (48)</p>
                        </div>
                    </div>
                </div>
                <div class=\"col-12 col-md-4 mb-4\">
                    <div class=\"card h-100\">
                        <a href=\"shop-single.html\">
                            <img src=\"{{asset('img/feature_prod_03.jpg')}}\" class=\"card-img-top\" alt=\"...\">
                        </a>
                        <div class=\"card-body\">
                            <ul class=\"list-unstyled d-flex justify-content-between\">
                                <li>
                                    <i class=\"text-warning fa fa-star\"></i>
                                    <i class=\"text-warning fa fa-star\"></i>
                                    <i class=\"text-warning fa fa-star\"></i>
                                    <i class=\"text-warning fa fa-star\"></i>
                                    <i class=\"text-warning fa fa-star\"></i>
                                </li>
                                <li class=\"text-muted text-right\">\$360.00</li>
                            </ul>
                            <a href=\"shop-single.html\" class=\"h2 text-decoration-none text-dark\">Summer Addides Shoes</a>
                            <p class=\"card-text\">
                                Curabitur ac mi sit amet diam luctus porta. Phasellus pulvinar sagittis diam, et scelerisque ipsum lobortis nec.
                            </p>
                            <p class=\"text-muted\">Reviews (74)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- End Hedi Feed -->

    <!-- Start Hazem -->
    <div id=\"template-mo-zay-hero-carousel\" class=\"carousel slide\" data-bs-ride=\"carousel\" data-aos=\"fade-right\">
        
        <div class=\"carousel-inner\">
            <div class=\"carousel-item active\">
                <div class=\"container\">
                    <div class=\"row p-5\">
                        <div class=\"mx-auto col-md-8 col-lg-6 order-lg-last\">
                            <img class=\"img-fluid\" src=\"{{asset('img/avis.png')}}\" alt=\"\">
                        </div>
                        <div class=\"col-lg-6 mb-0 d-flex align-items-center justify-content-center\">
                            <div class=\"text-center\">
                                <a class=\"nav-link\" href=\"\" style=\"color: inherit;\" onmouseover=\"this.children[0].style.color='#28a745';\" onmouseout=\"this.children[0].style.color='#808080';\">
                                    <h1 ><b>Laissez Un Avis ?</b></h1>
                                </a>
                                <h3 class=\"h2\">Accédez au blog et partagez vos avis !</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
        
        
    </div>
    <!-- End Hazem -->
    {% endblock %}


    <!-- Start Footer -->
     {% block footer %}
    <footer class=\"bg-dark\" id=\"tempaltemo_footer\">
        <div class=\"container\">
            <div class=\"row\">

                <div class=\"col-md-4 pt-5\">
                    <h2 class=\"h2 text-success border-bottom pb-3 border-light logo\">Smart Moby</h2>
                    <ul class=\"list-unstyled text-light footer-link-list\">
                        <li>
                            <i class=\"fas fa-map-marker-alt fa-fw\"></i>
                            Cité El Ghazela, Ariana, Tunis
                        </li>
                        <li>
                            <i class=\"fa fa-phone fa-fw\"></i>
                            <a class=\"text-decoration-none\" >+216 98 444 555</a>
                        </li>
                        <li>
                            <i class=\"fa fa-envelope fa-fw\"></i>
                            <a class=\"text-decoration-none\" >info@smart_moby.com</a>
                        </li>
                    </ul>
                </div>

                

            </div>

            
                
        </div>

        <div class=\"w-100 bg-black py-3\">
            <div class=\"container\">
                <div class=\"row pt-2\">
                    <div class=\"col-12\">
                        <p class=\"text-left text-light\">
                            Copyright &copy; 2025 Smart Moby Co., Ltd.
                            
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </footer>
    {% endblock %}
    <!-- End Footer -->

    {% block js %}
    <!-- Start Script -->
    <script src=\"{{asset('js/jquery-1.11.0.min.js')}}\"></script>
    <script src=\"{{asset('js/jquery-migrate-1.2.1.min.js')}}\"></script>
    <script src=\"{{asset('js/bootstrap.bundle.min.js')}}\"></script>
    <script src=\"{{asset('js/templatemo.js')}}\"></script>
    <script src=\"{{asset('js/custom.js')}}\"></script>
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js\"></script>
    <script>
        AOS.init(); // Initialise AOS
    </script>
    {% endblock %}
    <!-- End Script -->
</body>

</html>", "base.html.twig", "C:\\Users\\user\\Desktop\\symfonyfareszakrawicrud\\hamhama\\templates\\base.html.twig");
    }
}
