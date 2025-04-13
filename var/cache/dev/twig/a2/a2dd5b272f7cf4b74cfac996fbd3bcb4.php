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

/* back_base.html.twig */
class __TwigTemplate_41f05bad39bdeedd5dbd094431df022f extends Template
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
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "back_base.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "back_base.html.twig"));

        // line 1
        yield "<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>AdminLTE v4</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>

  <!-- Favicon Icon -->
  <link rel=\"icon\" href=\"";
        // line 10
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("favicon.ico"), "html", null, true);
        yield "\" type=\"image/x-icon\">
  
  <!-- CSS Assets -->
  <link rel=\"stylesheet\" href=\"";
        // line 13
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/css/bootstrap.min.css"), "html", null, true);
        yield "\">
  <link rel=\"stylesheet\" href=\"";
        // line 14
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/css/quicksand.css"), "html", null, true);
        yield "\">
  <link rel=\"stylesheet\" href=\"";
        // line 15
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/css/style.css"), "html", null, true);
        yield "\">
  <link rel=\"stylesheet\" href=\"";
        // line 16
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/css/fontawesome-all.min.css"), "html", null, true);
        yield "\">
  <link rel=\"stylesheet\" href=\"";
        // line 17
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/css/fontawesome.css"), "html", null, true);
        yield "\">
  <link rel=\"stylesheet\" href=\"";
        // line 18
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/css/animate.min.css"), "html", null, true);
        yield "\">
  <link rel=\"stylesheet\" href=\"";
        // line 19
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/css/chartist.min.css"), "html", null, true);
        yield "\">
  <link rel=\"stylesheet\" href=\"";
        // line 20
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/css/jquery-jvectormap-2.0.2.css"), "html", null, true);
        yield "\">
  <link rel=\"stylesheet\" href=\"";
        // line 21
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/js/calendar/bootstrap_calendar.css"), "html", null, true);
        yield "\">
  <link rel=\"stylesheet\" href=\"";
        // line 22
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/css/nice-select.css"), "html", null, true);
        yield "\">
</head>
<body>
     <div class=\"loader-wrapper\">
        <div class=\"loader-circle\">
            <div class=\"loader-wave\"></div>
        </div>
    </div>
    <!--Page loader-->
    
    <!--Page Wrapper-->

    <div class=\"container-fluid\">

        <!--Header-->
        <div class=\"row header shadow-sm\">
            
            <!--Logo-->
            <div class=\"col-sm-3 pl-0 text-center header-logo\">
               <div class=\"bg-theme mr-3 pt-3 pb-2 mb-0\">
                    <h3 class=\"logo\"><a href=\"#\" class=\"text-secondary logo\"><i class=\"fa fa-rocket\"></i> Sleek<span class=\"small\">admin</span></a></h3>
               </div>
            </div>
            <!--Logo-->

            <!--Header Menu-->
            <div class=\"col-sm-9 header-menu pt-2 pb-0\">
                <div class=\"row\">
                    
                    <!--Menu Icons-->
                    <div class=\"col-sm-4 col-8 pl-0\">
                        <!--Toggle sidebar-->
                        <span class=\"menu-icon\" onclick=\"toggle_sidebar()\">
                            <span id=\"sidebar-toggle-btn\"></span>
                        </span>
                        <!--Toggle sidebar-->
                        <!--Notification icon-->
                        <div class=\"menu-icon\">
                            <a class=\"\" href=\"#\" onclick=\"toggle_dropdown(this); return false\" role=\"button\" class=\"dropdown-toggle\">
                                <i class=\"fa fa-bell\"></i>
                                <span class=\"badge badge-danger\">5</span>
                            </a>
                            <div class=\"dropdown dropdown-left bg-white shadow border\">
                                <a class=\"dropdown-item\" href=\"#\"><strong>Notifications</strong></a>
                                <div class=\"dropdown-divider\"></div>
                                <a href=\"#\" class=\"dropdown-item\">
                                    <div class=\"media\">
                                        <div class=\"align-self-center mr-3 rounded-circle notify-icon bg-primary\">
                                            <i class=\"fa fa-bookmark\"></i>
                                        </div>
                                        <div class=\"media-body\">
                                            <h6 class=\"mt-0\"><strong>Meeting</strong></h6>
                                            <p>You have a meeting by 8:00</p>
                                            <small class=\"text-success\">09:23am</small>
                                        </div>
                                    </div>
                                </a>
                                <div class=\"dropdown-divider\"></div>
                                <a href=\"#\" class=\"dropdown-item\">
                                    <div class=\"media\">
                                        <div class=\"align-self-center mr-3 rounded-circle notify-icon bg-secondary\">
                                            <i class=\"fa fa-link\"></i>
                                        </div>
                                        <div class=\"media-body\">
                                            <h6 class=\"mt-0\"><strong>Events</strong></h6>
                                            <p>Launching new programme</p>
                                            <small class=\"text-success\">09:23am</small>
                                        </div>
                                    </div>
                                </a>
                                <div class=\"dropdown-divider\"></div>
                                <a href=\"#\" class=\"dropdown-item\">
                                    <div class=\"media\">
                                        <div class=\"align-self-center mr-3 rounded-circle notify-icon bg-warning\">
                                            <i class=\"fa fa-user\"></i>
                                        </div>
                                        <div class=\"media-body\">
                                            <h6 class=\"mt-0\"><strong>Personnel</strong></h6>
                                            <p>New employee arrival</p>
                                            <small class=\"text-success\">09:23am</small>
                                        </div>
                                    </div>
                                </a>
                                <div class=\"dropdown-divider\"></div>
                                <a class=\"dropdown-item text-center link-all\" href=\"#\">See all notifications ></a>
                            </div>
                        </div>
                        <!--Notication icon-->

                        <!--Inbox icon-->
                        <span class=\"menu-icon inbox\">
                            <a class=\"\" href=\"#\" role=\"button\" id=\"dropdownMenuLink3\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                                <i class=\"fa fa-envelope\"></i>
                                <span class=\"badge badge-danger\">4</span>
                            </a>
                            <div class=\"dropdown-menu dropdown-menu-left mt-10 animated zoomInDown\" aria-labelledby=\"dropdownMenuLink3\">
                                <a class=\"dropdown-item\" href=\"#\"><strong>Unread messages</strong></a>
                                <div class=\"dropdown-divider\"></div>
                                <a href=\"#\" class=\"dropdown-item\">
                                    <div class=\"media\">
                                        <img class=\"align-self-center mr-3 rounded-circle\" src=\"assets/img/profile.jpg\" width=\"50px\" height=\"50px\" alt=\"Generic placeholder image\">
                                        <div class=\"media-body\">
                                            <h6 class=\"mt-0\"><strong>Adam Abdulrahman</strong></h6>
                                            <p>How are you?</p>
                                            <small class=\"text-success\">09:23am</small>
                                        </div>
                                    </div>
                                </a>
                                <div class=\"dropdown-divider\"></div>
                                <a href=\"#\" class=\"dropdown-item\">
                                    <div class=\"media\">
                                        <img class=\"align-self-center mr-3 rounded-circle\" src=\"assets/img/profile.jpg\" width=\"50px\" height=\"50px\" alt=\"Generic placeholder image\">
                                        <div class=\"media-body\">
                                            <h6 class=\"mt-0\"><strong>Adam Abdulrahman</strong></h6>
                                            <p>How are you?</p>
                                            <small class=\"text-success\">09:23am</small>
                                        </div>
                                    </div>
                                </a>
                                <div class=\"dropdown-divider\"></div>
                                <a href=\"#\" class=\"dropdown-item\">
                                    <div class=\"media\">
                                        <img class=\"align-self-center mr-3 rounded-circle\" src=\"assets/img/profile.jpg\" width=\"50px\" height=\"50px\" alt=\"Generic placeholder image\">
                                        <div class=\"media-body\">
                                            <h6 class=\"mt-0\"><strong>Adam Abdulrahman</strong></h6>
                                            <p>How are you?</p>
                                            <small class=\"text-success\">09:23am</small>
                                        </div>
                                    </div>
                                </a>
                                <div class=\"dropdown-divider\"></div>
                                <a class=\"dropdown-item text-center link-all\" href=\"#\">View all messages</a>
                            </div>
                        </span>
                        <!--Inbox icon-->
                        <span class=\"menu-icon\">
                            <i class=\"fa fa-th-large\"></i>
                        </span>
                    </div>
                    <!--Menu Icons-->

                    <!--Search box and avatar-->
                    <div class=\"col-sm-8 col-4 text-right flex-header-menu justify-content-end\">
                        <div class=\"search-rounded mr-3\">
                            <input type=\"text\" class=\"form-control search-box\" placeholder=\"Enter keywords..\" />
                        </div>
                        <div class=\"mr-4\">
                            <a class=\"\" href=\"#\" role=\"button\" id=\"dropdownMenuLink\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                                <img src=\"assets/img/profile.jpg\" alt=\"Adam\" class=\"rounded-circle\" width=\"40px\" height=\"40px\">
                            </a>
                            <div class=\"dropdown-menu dropdown-menu-right mt-13\" aria-labelledby=\"dropdownMenuLink\">
                                <a class=\"dropdown-item\" href=\"#\"><i class=\"fa fa-user pr-2\"></i> Profile</a>
                                <div class=\"dropdown-divider\"></div>
                                <a class=\"dropdown-item\" href=\"#\"><i class=\"fa fa-th-list pr-2\"></i> Tasks</a>
                                <div class=\"dropdown-divider\"></div>
                                <a class=\"dropdown-item\" href=\"#\"><i class=\"fa fa-book pr-2\"></i> Projects</a>
                                <div class=\"dropdown-divider\"></div>
                                <a class=\"dropdown-item\" href=\"#\"><i class=\"fa fa-power-off pr-2\"></i> Logout</a>
                            </div>
                        </div>
                    </div>
                    <!--Search box and avatar-->
                </div>    
            </div>
            <!--Header Menu-->
        </div>
        <!--Header-->

        <!--Main Content-->

        <div class=\"row main-content\">
            <!--Sidebar left-->
            <div class=\"col-sm-3 col-xs-6 sidebar pl-0\">
                <div class=\"inner-sidebar mr-3\">
                    <!--Image Avatar-->
                    <div class=\"avatar text-center\">
                        <img src=\"assets/img/client-img4.png\" alt=\"\" class=\"rounded-circle\" />
                        <p><strong>Jonathan Clarke</strong></p>
                        <span class=\"text-primary small\"><strong>UI/UX Designer</strong></span>
                    </div>
                    <!--Image Avatar-->

                    <!--Sidebar Navigation Menu-->
                    <div class=\"sidebar-menu-container\">
                        <ul class=\"sidebar-menu mt-4 mb-4\">
                            <li class=\"parent\">
                                <a href=\"#\" onclick=\"toggle_menu('dashboard'); return false\" class=\"\"><i class=\"fa fa-dashboard mr-3\"> </i>
                                    <span class=\"none\">Dashboard <i class=\"fa fa-angle-down pull-right align-bottom\"></i></span>
                                </a>
                                <ul class=\"children\" id=\"dashboard\">
                                    <li class=\"child\"><a href=\"index.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Default</a></li>
                                    <li class=\"child\"><a href=\"index2.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Analytics</a></li>
                                    <li class=\"child\"><a href=\"index3.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Ecommerce</a></li>
                                    <li class=\"child\"><a href=\"index4.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Cryptocurrency</a></li>
                                </ul>
                            </li>
                            </li>
                            <li class=\"parent\">
                                <a href=\"";
        // line 220
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_service_index");
        yield "\" class=\"\"><i class=\"fa fa-puzzle-piece mr-3\"></i>
                                    <span class=\"none\">Services </span>
                                </a>
                            </li>
                              <li class=\"parent\">
                                <a href=\"";
        // line 225
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_categorie_index");
        yield "\" class=\"\"><i class=\"fa fa-puzzle-piece mr-3\"></i>
                                    <span class=\"none\">Categories </span>
                                </a>
                            </li>
                            <li class=\"parent\">
                                <a href=\"#\" onclick=\"toggle_menu('ul_element'); return false\" class=\"\"><i class=\"fa fa-puzzle-piece mr-3\"></i>
                                    <span class=\"none\">UI Elements <i class=\"fa fa-angle-down pull-right align-bottom\"></i></span>
                                </a>
                                <ul class=\"children\" id=\"ul_element\">
                                    <li class=\"child\"><a href=\"accordion.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Accordions</a></li>
                                    <li class=\"child\"><a href=\"buttons.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Buttons</a></li>
                                    <li class=\"child\"><a href=\"badges.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Badges</a></li>
                                    <li class=\"child\"><a href=\"breadcrumb.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Breadcrumbs</a></li>
                                    <li class=\"child\"><a href=\"cards.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Cards</a></li>
                                    <li class=\"child\"><a href=\"icons.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Icons</a></li>
                                    <li class=\"child\"><a href=\"modal.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Modals</a></li>
                                    <li class=\"child\"><a href=\"notification.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Notification</a></li>
                                    <li class=\"child\"><a href=\"progressbar.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Progressbar</a></li>
                                    <li class=\"child\"><a href=\"sweetalert.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Sweet alert</a></li>
                                    <li class=\"child\"><a href=\"tabs.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Tabs</a></li>
                                    <li class=\"child\"><a href=\"tooltip-popover.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Tooltip and Popovers</a></li>
                                    <li class=\"child\"><a href=\"typography.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Typography</a></li>
                                </ul>
                            </li>
                            <li class=\"parent\">
                                <a href=\"#\" onclick=\"toggle_menu('form_element'); return false\" class=\"\"><i class=\"fa fa-pencil-square mr-3\"></i>
                                    <span class=\"none\">Form Elements <i class=\"fa fa-angle-down pull-right align-bottom\"></i></span>
                                </a>
                                <ul class=\"children\" id=\"form_element\">
                                    <li class=\"child\"><a href=\"form-general.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Basic Elements</a></li>
                                    <li class=\"child\"><a href=\"form-advanced.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Advanced Elements</a></li>
                                    <li class=\"child\"><a href=\"form-validation.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Validation</a></li>
                                    <li class=\"child\"><a href=\"form-wizard.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Form Wizard</a></li>
                                </ul>
                            </li>
                            <li class=\"parent\">
                                <a href=\"#\" onclick=\"toggle_menu('editors'); return false\" class=\"\"><i class=\"fa fa-pencil-square-o mr-3\"></i>
                                    <span class=\"none\">Text Editors <i class=\"fa fa-angle-down pull-right align-bottom\"></i></span>
                                </a>
                                <ul class=\"children\" id=\"editors\">
                                    <li class=\"child\"><a href=\"ckeditor-classic.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Ckeditor classic</a></li>
                                    <li class=\"child\"><a href=\"ckeditor-inline.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Ckeditor inline</a></li>
                                    <li class=\"child\"><a href=\"ckeditor-document.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Ckeditor document</a></li>
                                    <li class=\"child\"><a href=\"summernote.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Summernote editor</a></li>
                                </ul>
                            </li>
                            <li class=\"parent\">
                                <a href=\"#\" onclick=\"toggle_menu('tables'); return false\" class=\"\"><i class=\"fa fa-pencil-square mr-3\"></i>
                                    <span class=\"none\">Tables <i class=\"fa fa-angle-down pull-right align-bottom\"></i></span>
                                </a>
                                <ul class=\"children\" id=\"tables\">
                                    <li class=\"child\"><a href=\"basic-tables.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Basic Tables</a></li>
                                    <li class=\"child\"><a href=\"datatable.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Datatables</a></li>
                                    <li class=\"child\"><a href=\"jsgrid-table.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> JSGrid Tables</a></li>
                                </ul>
                            </li>
                            <li class=\"parent\">
                                <a href=\"#\" onclick=\"toggle_menu('charts'); return false\" class=\"\"><i class=\"fa fa-pie-chart mr-3\"></i>
                                    <span class=\"none\">Charts <i class=\"fa fa-angle-down pull-right align-bottom\"></i></span>
                                </a>
                                <ul class=\"children\" id=\"charts\">
                                    <li class=\"child\"><a href=\"chart.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Chart JS</a></li>
                                    <li class=\"child\"><a href=\"chartist.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Chartist JS</a></li>
                                    <li class=\"child\"><a href=\"echarts.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Echarts JS</a></li>
                                    <li class=\"child\"><a href=\"flot.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Flot JS</a></li>
                                    <li class=\"child\"><a href=\"morris.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Morris JS</a></li>
                                    <li class=\"child\"><a href=\"nvd3.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> NVD3 JS</a></li>
                                    <li class=\"child\"><a href=\"sparkline.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Sparkline JS</a></li>
                                </ul>
                            </li>
                            <li class=\"parent\">
                                <a href=\"icons.html\" class=\"\"><i class=\"fa fa-toggle-on mr-3\"></i>
                                    <span class=\"none\">Icons</span>
                                </a>
                            </li>
                            <li class=\"parent\">
                                <a href=\"#\" onclick=\"toggle_menu('ecommerce'); return false\" class=\"\"><i class=\"fa fa-shopping-cart mr-3\"></i>
                                    <span class=\"none\">Ecommerce <i class=\"fa fa-angle-down pull-right align-bottom\"></i></span>
                                </a>
                                <ul class=\"children\" id=\"ecommerce\">
                                    <li class=\"child\"><a href=\"products.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> ProductList</a></li>
                                    <li class=\"child\"><a href=\"product-detail.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> ProductDetail</a></li>
                                    <li class=\"child\"><a href=\"orders.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> OrderList</a></li>
                                    <li class=\"child\"><a href=\"invoice.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Invoice</a></li>
                                </ul>
                            </li>
                            <li class=\"parent\">
                                <a href=\"#\" onclick=\"toggle_menu('maps'); return false\" class=\"\"><i class=\"fa fa-map mr-3\"></i>
                                    <span class=\"none\">Maps <i class=\"fa fa-angle-down pull-right align-bottom\"></i></span>
                                </a>
                                <ul class=\"children\" id=\"maps\">
                                    <li class=\"child\"><a href=\"jvector-maps.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Jvector Maps</a></li>
                                    <li class=\"child\"><a href=\"google-maps.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Google Maps</a></li>
                                </ul>
                            </li>
                            <li class=\"parent\">
                                <a href=\"#\" onclick=\"toggle_menu('pages'); return false\" class=\"\"><i class=\"fa fa-file mr-3\"></i>
                                    <span class=\"none\">Pages <i class=\"fa fa-angle-down pull-right align-bottom\"></i></span>
                                </a>
                                <ul class=\"children\" id=\"pages\">
                                    <li class=\"child\"><a href=\"email-inbox.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Email-Inbox</a></li>
                                    <li class=\"child\"><a href=\"email.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Email-Compose</a></li>
                                    <li class=\"child\"><a href=\"login.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Login</a></li>
                                    <li class=\"child\"><a href=\"register.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Signup</a></li>
                                    <li class=\"child\"><a href=\"lockscreen.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Lock Screen</a></li>
                                    <li class=\"child\"><a href=\"forgot-password.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Forgot Password</a></li>
                                    <li class=\"child\"><a href=\"profile.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Profile</a></li>
                                    <li class=\"child\"><a href=\"gallery.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Gallery</a></li>
                                    <li class=\"child\"><a href=\"invoice.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Invoice</a></li>
                                    <li class=\"child\"><a href=\"search-result.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Search</a></li>
                                    <li class=\"child\"><a href=\"pricing.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Pricing</a></li>
                                    <li class=\"child\"><a href=\"blank.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Blank Page</a></li>
                                    <li class=\"child\"><a href=\"error-404.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Error 404</a></li>
                                    <li class=\"child\"><a href=\"error-500.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Error 500</a></li>
                                    <li class=\"child\"><a href=\"error-504.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Error 504</a></li>
                                </ul>
                            </li>
                            <li class=\"parent\">
                                <a href=\"fullcalendar.html\" class=\"\"><i class=\"fa fa-calendar-o mr-3\"> </i>
                                    <span class=\"none\">Full Calendar </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--Sidebar Naigation Menu-->
                </div>
            </div>
            <!--Sidebar left-->

            <!--Content right-->
            <div class=\"col-sm-9 col-xs-12 content pt-3 pl-0\">
                <h5 class=\"mb-3\" ><strong>Dashboard</strong></h5>
                
                <!--Dashboard widget-->
                    ";
        // line 359
        yield from $this->unwrap()->yieldBlock('body', $context, $blocks);
        // line 360
        yield "                <!--Footer-->

            </div>
        </div>

        <!--Main Content-->

    </div>
  <!-- JS Assets -->
  <script src=\"";
        // line 369
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/js/jquery.min.js"), "html", null, true);
        yield "\"></script>
  <script src=\"";
        // line 370
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/js/jquery-1.12.4.min.js"), "html", null, true);
        yield "\"></script>
  <script src=\"";
        // line 371
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/js/popper.min.js"), "html", null, true);
        yield "\"></script>
  <script src=\"";
        // line 372
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/js/bootstrap.min.js"), "html", null, true);
        yield "\"></script>
  <script src=\"";
        // line 373
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/js/sweetalert.js"), "html", null, true);
        yield "\"></script>
  <script src=\"";
        // line 374
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/js/progressbar.min.js"), "html", null, true);
        yield "\"></script>
  
  <!-- Chart JS -->
  <script src=\"";
        // line 377
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/js/charts/jquery.flot.min.js"), "html", null, true);
        yield "\"></script>
  <script src=\"";
        // line 378
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/js/charts/jquery.flot.pie.min.js"), "html", null, true);
        yield "\"></script>
  <script src=\"";
        // line 379
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/js/charts/jquery.flot.categories.min.js"), "html", null, true);
        yield "\"></script>
  <script src=\"";
        // line 380
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/js/charts/jquery.flot.stack.min.js"), "html", null, true);
        yield "\"></script>
  <script src=\"";
        // line 381
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/js/charts/chart.min.js"), "html", null, true);
        yield "\"></script>
  <script src=\"";
        // line 382
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/js/charts/chartist.min.js"), "html", null, true);
        yield "\"></script>
  <script src=\"";
        // line 383
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/js/charts/chartist-data.js"), "html", null, true);
        yield "\"></script>
  <script src=\"";
        // line 384
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/js/charts/demo.js"), "html", null, true);
        yield "\"></script>
  
  <!-- Maps JS -->
  <script src=\"";
        // line 387
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/js/maps/jquery-jvectormap-2.0.2.min.js"), "html", null, true);
        yield "\"></script>
  <script src=\"";
        // line 388
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/js/maps/jquery-jvectormap-world-mill-en.js"), "html", null, true);
        yield "\"></script>
  <script src=\"";
        // line 389
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/js/maps/jvector-maps.js"), "html", null, true);
        yield "\"></script>
  
  <!-- Calendar JS -->
  <script src=\"";
        // line 392
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/js/calendar/bootstrap_calendar.js"), "html", null, true);
        yield "\"></script>
  <script src=\"";
        // line 393
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/js/calendar/demo.js"), "html", null, true);
        yield "\"></script>
  
  <!-- Nice Select -->
  <script src=\"";
        // line 396
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/js/jquery.nice-select.min.js"), "html", null, true);
        yield "\"></script>
  
  <!-- Custom JS -->
  <script src=\"";
        // line 399
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/js/custom.js"), "html", null, true);
        yield "\"></script>
  
  <script>
    // Nice select initialization
    \$(document).ready(function() {
      \$('.bulk-actions').niceSelect();
    });
  </script>
</body>
</html>";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 359
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

        yield "  ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "back_base.html.twig";
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
        return array (  572 => 359,  551 => 399,  545 => 396,  539 => 393,  535 => 392,  529 => 389,  525 => 388,  521 => 387,  515 => 384,  511 => 383,  507 => 382,  503 => 381,  499 => 380,  495 => 379,  491 => 378,  487 => 377,  481 => 374,  477 => 373,  473 => 372,  469 => 371,  465 => 370,  461 => 369,  450 => 360,  448 => 359,  311 => 225,  303 => 220,  102 => 22,  98 => 21,  94 => 20,  90 => 19,  86 => 18,  82 => 17,  78 => 16,  74 => 15,  70 => 14,  66 => 13,  60 => 10,  49 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>AdminLTE v4</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>

  <!-- Favicon Icon -->
  <link rel=\"icon\" href=\"{{ asset('favicon.ico') }}\" type=\"image/x-icon\">
  
  <!-- CSS Assets -->
  <link rel=\"stylesheet\" href=\"{{ asset('assets/css/bootstrap.min.css') }}\">
  <link rel=\"stylesheet\" href=\"{{ asset('assets/css/quicksand.css') }}\">
  <link rel=\"stylesheet\" href=\"{{ asset('assets/css/style.css') }}\">
  <link rel=\"stylesheet\" href=\"{{ asset('assets/css/fontawesome-all.min.css') }}\">
  <link rel=\"stylesheet\" href=\"{{ asset('assets/css/fontawesome.css') }}\">
  <link rel=\"stylesheet\" href=\"{{ asset('assets/css/animate.min.css') }}\">
  <link rel=\"stylesheet\" href=\"{{ asset('assets/css/chartist.min.css') }}\">
  <link rel=\"stylesheet\" href=\"{{ asset('assets/css/jquery-jvectormap-2.0.2.css') }}\">
  <link rel=\"stylesheet\" href=\"{{ asset('assets/js/calendar/bootstrap_calendar.css') }}\">
  <link rel=\"stylesheet\" href=\"{{ asset('assets/css/nice-select.css') }}\">
</head>
<body>
     <div class=\"loader-wrapper\">
        <div class=\"loader-circle\">
            <div class=\"loader-wave\"></div>
        </div>
    </div>
    <!--Page loader-->
    
    <!--Page Wrapper-->

    <div class=\"container-fluid\">

        <!--Header-->
        <div class=\"row header shadow-sm\">
            
            <!--Logo-->
            <div class=\"col-sm-3 pl-0 text-center header-logo\">
               <div class=\"bg-theme mr-3 pt-3 pb-2 mb-0\">
                    <h3 class=\"logo\"><a href=\"#\" class=\"text-secondary logo\"><i class=\"fa fa-rocket\"></i> Sleek<span class=\"small\">admin</span></a></h3>
               </div>
            </div>
            <!--Logo-->

            <!--Header Menu-->
            <div class=\"col-sm-9 header-menu pt-2 pb-0\">
                <div class=\"row\">
                    
                    <!--Menu Icons-->
                    <div class=\"col-sm-4 col-8 pl-0\">
                        <!--Toggle sidebar-->
                        <span class=\"menu-icon\" onclick=\"toggle_sidebar()\">
                            <span id=\"sidebar-toggle-btn\"></span>
                        </span>
                        <!--Toggle sidebar-->
                        <!--Notification icon-->
                        <div class=\"menu-icon\">
                            <a class=\"\" href=\"#\" onclick=\"toggle_dropdown(this); return false\" role=\"button\" class=\"dropdown-toggle\">
                                <i class=\"fa fa-bell\"></i>
                                <span class=\"badge badge-danger\">5</span>
                            </a>
                            <div class=\"dropdown dropdown-left bg-white shadow border\">
                                <a class=\"dropdown-item\" href=\"#\"><strong>Notifications</strong></a>
                                <div class=\"dropdown-divider\"></div>
                                <a href=\"#\" class=\"dropdown-item\">
                                    <div class=\"media\">
                                        <div class=\"align-self-center mr-3 rounded-circle notify-icon bg-primary\">
                                            <i class=\"fa fa-bookmark\"></i>
                                        </div>
                                        <div class=\"media-body\">
                                            <h6 class=\"mt-0\"><strong>Meeting</strong></h6>
                                            <p>You have a meeting by 8:00</p>
                                            <small class=\"text-success\">09:23am</small>
                                        </div>
                                    </div>
                                </a>
                                <div class=\"dropdown-divider\"></div>
                                <a href=\"#\" class=\"dropdown-item\">
                                    <div class=\"media\">
                                        <div class=\"align-self-center mr-3 rounded-circle notify-icon bg-secondary\">
                                            <i class=\"fa fa-link\"></i>
                                        </div>
                                        <div class=\"media-body\">
                                            <h6 class=\"mt-0\"><strong>Events</strong></h6>
                                            <p>Launching new programme</p>
                                            <small class=\"text-success\">09:23am</small>
                                        </div>
                                    </div>
                                </a>
                                <div class=\"dropdown-divider\"></div>
                                <a href=\"#\" class=\"dropdown-item\">
                                    <div class=\"media\">
                                        <div class=\"align-self-center mr-3 rounded-circle notify-icon bg-warning\">
                                            <i class=\"fa fa-user\"></i>
                                        </div>
                                        <div class=\"media-body\">
                                            <h6 class=\"mt-0\"><strong>Personnel</strong></h6>
                                            <p>New employee arrival</p>
                                            <small class=\"text-success\">09:23am</small>
                                        </div>
                                    </div>
                                </a>
                                <div class=\"dropdown-divider\"></div>
                                <a class=\"dropdown-item text-center link-all\" href=\"#\">See all notifications ></a>
                            </div>
                        </div>
                        <!--Notication icon-->

                        <!--Inbox icon-->
                        <span class=\"menu-icon inbox\">
                            <a class=\"\" href=\"#\" role=\"button\" id=\"dropdownMenuLink3\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                                <i class=\"fa fa-envelope\"></i>
                                <span class=\"badge badge-danger\">4</span>
                            </a>
                            <div class=\"dropdown-menu dropdown-menu-left mt-10 animated zoomInDown\" aria-labelledby=\"dropdownMenuLink3\">
                                <a class=\"dropdown-item\" href=\"#\"><strong>Unread messages</strong></a>
                                <div class=\"dropdown-divider\"></div>
                                <a href=\"#\" class=\"dropdown-item\">
                                    <div class=\"media\">
                                        <img class=\"align-self-center mr-3 rounded-circle\" src=\"assets/img/profile.jpg\" width=\"50px\" height=\"50px\" alt=\"Generic placeholder image\">
                                        <div class=\"media-body\">
                                            <h6 class=\"mt-0\"><strong>Adam Abdulrahman</strong></h6>
                                            <p>How are you?</p>
                                            <small class=\"text-success\">09:23am</small>
                                        </div>
                                    </div>
                                </a>
                                <div class=\"dropdown-divider\"></div>
                                <a href=\"#\" class=\"dropdown-item\">
                                    <div class=\"media\">
                                        <img class=\"align-self-center mr-3 rounded-circle\" src=\"assets/img/profile.jpg\" width=\"50px\" height=\"50px\" alt=\"Generic placeholder image\">
                                        <div class=\"media-body\">
                                            <h6 class=\"mt-0\"><strong>Adam Abdulrahman</strong></h6>
                                            <p>How are you?</p>
                                            <small class=\"text-success\">09:23am</small>
                                        </div>
                                    </div>
                                </a>
                                <div class=\"dropdown-divider\"></div>
                                <a href=\"#\" class=\"dropdown-item\">
                                    <div class=\"media\">
                                        <img class=\"align-self-center mr-3 rounded-circle\" src=\"assets/img/profile.jpg\" width=\"50px\" height=\"50px\" alt=\"Generic placeholder image\">
                                        <div class=\"media-body\">
                                            <h6 class=\"mt-0\"><strong>Adam Abdulrahman</strong></h6>
                                            <p>How are you?</p>
                                            <small class=\"text-success\">09:23am</small>
                                        </div>
                                    </div>
                                </a>
                                <div class=\"dropdown-divider\"></div>
                                <a class=\"dropdown-item text-center link-all\" href=\"#\">View all messages</a>
                            </div>
                        </span>
                        <!--Inbox icon-->
                        <span class=\"menu-icon\">
                            <i class=\"fa fa-th-large\"></i>
                        </span>
                    </div>
                    <!--Menu Icons-->

                    <!--Search box and avatar-->
                    <div class=\"col-sm-8 col-4 text-right flex-header-menu justify-content-end\">
                        <div class=\"search-rounded mr-3\">
                            <input type=\"text\" class=\"form-control search-box\" placeholder=\"Enter keywords..\" />
                        </div>
                        <div class=\"mr-4\">
                            <a class=\"\" href=\"#\" role=\"button\" id=\"dropdownMenuLink\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                                <img src=\"assets/img/profile.jpg\" alt=\"Adam\" class=\"rounded-circle\" width=\"40px\" height=\"40px\">
                            </a>
                            <div class=\"dropdown-menu dropdown-menu-right mt-13\" aria-labelledby=\"dropdownMenuLink\">
                                <a class=\"dropdown-item\" href=\"#\"><i class=\"fa fa-user pr-2\"></i> Profile</a>
                                <div class=\"dropdown-divider\"></div>
                                <a class=\"dropdown-item\" href=\"#\"><i class=\"fa fa-th-list pr-2\"></i> Tasks</a>
                                <div class=\"dropdown-divider\"></div>
                                <a class=\"dropdown-item\" href=\"#\"><i class=\"fa fa-book pr-2\"></i> Projects</a>
                                <div class=\"dropdown-divider\"></div>
                                <a class=\"dropdown-item\" href=\"#\"><i class=\"fa fa-power-off pr-2\"></i> Logout</a>
                            </div>
                        </div>
                    </div>
                    <!--Search box and avatar-->
                </div>    
            </div>
            <!--Header Menu-->
        </div>
        <!--Header-->

        <!--Main Content-->

        <div class=\"row main-content\">
            <!--Sidebar left-->
            <div class=\"col-sm-3 col-xs-6 sidebar pl-0\">
                <div class=\"inner-sidebar mr-3\">
                    <!--Image Avatar-->
                    <div class=\"avatar text-center\">
                        <img src=\"assets/img/client-img4.png\" alt=\"\" class=\"rounded-circle\" />
                        <p><strong>Jonathan Clarke</strong></p>
                        <span class=\"text-primary small\"><strong>UI/UX Designer</strong></span>
                    </div>
                    <!--Image Avatar-->

                    <!--Sidebar Navigation Menu-->
                    <div class=\"sidebar-menu-container\">
                        <ul class=\"sidebar-menu mt-4 mb-4\">
                            <li class=\"parent\">
                                <a href=\"#\" onclick=\"toggle_menu('dashboard'); return false\" class=\"\"><i class=\"fa fa-dashboard mr-3\"> </i>
                                    <span class=\"none\">Dashboard <i class=\"fa fa-angle-down pull-right align-bottom\"></i></span>
                                </a>
                                <ul class=\"children\" id=\"dashboard\">
                                    <li class=\"child\"><a href=\"index.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Default</a></li>
                                    <li class=\"child\"><a href=\"index2.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Analytics</a></li>
                                    <li class=\"child\"><a href=\"index3.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Ecommerce</a></li>
                                    <li class=\"child\"><a href=\"index4.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Cryptocurrency</a></li>
                                </ul>
                            </li>
                            </li>
                            <li class=\"parent\">
                                <a href=\"{{path('app_service_index')}}\" class=\"\"><i class=\"fa fa-puzzle-piece mr-3\"></i>
                                    <span class=\"none\">Services </span>
                                </a>
                            </li>
                              <li class=\"parent\">
                                <a href=\"{{path('app_categorie_index')}}\" class=\"\"><i class=\"fa fa-puzzle-piece mr-3\"></i>
                                    <span class=\"none\">Categories </span>
                                </a>
                            </li>
                            <li class=\"parent\">
                                <a href=\"#\" onclick=\"toggle_menu('ul_element'); return false\" class=\"\"><i class=\"fa fa-puzzle-piece mr-3\"></i>
                                    <span class=\"none\">UI Elements <i class=\"fa fa-angle-down pull-right align-bottom\"></i></span>
                                </a>
                                <ul class=\"children\" id=\"ul_element\">
                                    <li class=\"child\"><a href=\"accordion.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Accordions</a></li>
                                    <li class=\"child\"><a href=\"buttons.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Buttons</a></li>
                                    <li class=\"child\"><a href=\"badges.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Badges</a></li>
                                    <li class=\"child\"><a href=\"breadcrumb.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Breadcrumbs</a></li>
                                    <li class=\"child\"><a href=\"cards.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Cards</a></li>
                                    <li class=\"child\"><a href=\"icons.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Icons</a></li>
                                    <li class=\"child\"><a href=\"modal.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Modals</a></li>
                                    <li class=\"child\"><a href=\"notification.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Notification</a></li>
                                    <li class=\"child\"><a href=\"progressbar.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Progressbar</a></li>
                                    <li class=\"child\"><a href=\"sweetalert.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Sweet alert</a></li>
                                    <li class=\"child\"><a href=\"tabs.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Tabs</a></li>
                                    <li class=\"child\"><a href=\"tooltip-popover.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Tooltip and Popovers</a></li>
                                    <li class=\"child\"><a href=\"typography.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Typography</a></li>
                                </ul>
                            </li>
                            <li class=\"parent\">
                                <a href=\"#\" onclick=\"toggle_menu('form_element'); return false\" class=\"\"><i class=\"fa fa-pencil-square mr-3\"></i>
                                    <span class=\"none\">Form Elements <i class=\"fa fa-angle-down pull-right align-bottom\"></i></span>
                                </a>
                                <ul class=\"children\" id=\"form_element\">
                                    <li class=\"child\"><a href=\"form-general.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Basic Elements</a></li>
                                    <li class=\"child\"><a href=\"form-advanced.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Advanced Elements</a></li>
                                    <li class=\"child\"><a href=\"form-validation.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Validation</a></li>
                                    <li class=\"child\"><a href=\"form-wizard.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Form Wizard</a></li>
                                </ul>
                            </li>
                            <li class=\"parent\">
                                <a href=\"#\" onclick=\"toggle_menu('editors'); return false\" class=\"\"><i class=\"fa fa-pencil-square-o mr-3\"></i>
                                    <span class=\"none\">Text Editors <i class=\"fa fa-angle-down pull-right align-bottom\"></i></span>
                                </a>
                                <ul class=\"children\" id=\"editors\">
                                    <li class=\"child\"><a href=\"ckeditor-classic.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Ckeditor classic</a></li>
                                    <li class=\"child\"><a href=\"ckeditor-inline.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Ckeditor inline</a></li>
                                    <li class=\"child\"><a href=\"ckeditor-document.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Ckeditor document</a></li>
                                    <li class=\"child\"><a href=\"summernote.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Summernote editor</a></li>
                                </ul>
                            </li>
                            <li class=\"parent\">
                                <a href=\"#\" onclick=\"toggle_menu('tables'); return false\" class=\"\"><i class=\"fa fa-pencil-square mr-3\"></i>
                                    <span class=\"none\">Tables <i class=\"fa fa-angle-down pull-right align-bottom\"></i></span>
                                </a>
                                <ul class=\"children\" id=\"tables\">
                                    <li class=\"child\"><a href=\"basic-tables.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Basic Tables</a></li>
                                    <li class=\"child\"><a href=\"datatable.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Datatables</a></li>
                                    <li class=\"child\"><a href=\"jsgrid-table.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> JSGrid Tables</a></li>
                                </ul>
                            </li>
                            <li class=\"parent\">
                                <a href=\"#\" onclick=\"toggle_menu('charts'); return false\" class=\"\"><i class=\"fa fa-pie-chart mr-3\"></i>
                                    <span class=\"none\">Charts <i class=\"fa fa-angle-down pull-right align-bottom\"></i></span>
                                </a>
                                <ul class=\"children\" id=\"charts\">
                                    <li class=\"child\"><a href=\"chart.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Chart JS</a></li>
                                    <li class=\"child\"><a href=\"chartist.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Chartist JS</a></li>
                                    <li class=\"child\"><a href=\"echarts.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Echarts JS</a></li>
                                    <li class=\"child\"><a href=\"flot.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Flot JS</a></li>
                                    <li class=\"child\"><a href=\"morris.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Morris JS</a></li>
                                    <li class=\"child\"><a href=\"nvd3.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> NVD3 JS</a></li>
                                    <li class=\"child\"><a href=\"sparkline.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Sparkline JS</a></li>
                                </ul>
                            </li>
                            <li class=\"parent\">
                                <a href=\"icons.html\" class=\"\"><i class=\"fa fa-toggle-on mr-3\"></i>
                                    <span class=\"none\">Icons</span>
                                </a>
                            </li>
                            <li class=\"parent\">
                                <a href=\"#\" onclick=\"toggle_menu('ecommerce'); return false\" class=\"\"><i class=\"fa fa-shopping-cart mr-3\"></i>
                                    <span class=\"none\">Ecommerce <i class=\"fa fa-angle-down pull-right align-bottom\"></i></span>
                                </a>
                                <ul class=\"children\" id=\"ecommerce\">
                                    <li class=\"child\"><a href=\"products.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> ProductList</a></li>
                                    <li class=\"child\"><a href=\"product-detail.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> ProductDetail</a></li>
                                    <li class=\"child\"><a href=\"orders.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> OrderList</a></li>
                                    <li class=\"child\"><a href=\"invoice.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Invoice</a></li>
                                </ul>
                            </li>
                            <li class=\"parent\">
                                <a href=\"#\" onclick=\"toggle_menu('maps'); return false\" class=\"\"><i class=\"fa fa-map mr-3\"></i>
                                    <span class=\"none\">Maps <i class=\"fa fa-angle-down pull-right align-bottom\"></i></span>
                                </a>
                                <ul class=\"children\" id=\"maps\">
                                    <li class=\"child\"><a href=\"jvector-maps.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Jvector Maps</a></li>
                                    <li class=\"child\"><a href=\"google-maps.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Google Maps</a></li>
                                </ul>
                            </li>
                            <li class=\"parent\">
                                <a href=\"#\" onclick=\"toggle_menu('pages'); return false\" class=\"\"><i class=\"fa fa-file mr-3\"></i>
                                    <span class=\"none\">Pages <i class=\"fa fa-angle-down pull-right align-bottom\"></i></span>
                                </a>
                                <ul class=\"children\" id=\"pages\">
                                    <li class=\"child\"><a href=\"email-inbox.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Email-Inbox</a></li>
                                    <li class=\"child\"><a href=\"email.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Email-Compose</a></li>
                                    <li class=\"child\"><a href=\"login.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Login</a></li>
                                    <li class=\"child\"><a href=\"register.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Signup</a></li>
                                    <li class=\"child\"><a href=\"lockscreen.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Lock Screen</a></li>
                                    <li class=\"child\"><a href=\"forgot-password.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Forgot Password</a></li>
                                    <li class=\"child\"><a href=\"profile.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Profile</a></li>
                                    <li class=\"child\"><a href=\"gallery.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Gallery</a></li>
                                    <li class=\"child\"><a href=\"invoice.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Invoice</a></li>
                                    <li class=\"child\"><a href=\"search-result.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Search</a></li>
                                    <li class=\"child\"><a href=\"pricing.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Pricing</a></li>
                                    <li class=\"child\"><a href=\"blank.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Blank Page</a></li>
                                    <li class=\"child\"><a href=\"error-404.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Error 404</a></li>
                                    <li class=\"child\"><a href=\"error-500.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Error 500</a></li>
                                    <li class=\"child\"><a href=\"error-504.html\" class=\"ml-4\"><i class=\"fa fa-angle-right mr-2\"></i> Error 504</a></li>
                                </ul>
                            </li>
                            <li class=\"parent\">
                                <a href=\"fullcalendar.html\" class=\"\"><i class=\"fa fa-calendar-o mr-3\"> </i>
                                    <span class=\"none\">Full Calendar </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--Sidebar Naigation Menu-->
                </div>
            </div>
            <!--Sidebar left-->

            <!--Content right-->
            <div class=\"col-sm-9 col-xs-12 content pt-3 pl-0\">
                <h5 class=\"mb-3\" ><strong>Dashboard</strong></h5>
                
                <!--Dashboard widget-->
                    {% block body %}  {% endblock %}
                <!--Footer-->

            </div>
        </div>

        <!--Main Content-->

    </div>
  <!-- JS Assets -->
  <script src=\"{{ asset('assets/js/jquery.min.js') }}\"></script>
  <script src=\"{{ asset('assets/js/jquery-1.12.4.min.js') }}\"></script>
  <script src=\"{{ asset('assets/js/popper.min.js') }}\"></script>
  <script src=\"{{ asset('assets/js/bootstrap.min.js') }}\"></script>
  <script src=\"{{ asset('assets/js/sweetalert.js') }}\"></script>
  <script src=\"{{ asset('assets/js/progressbar.min.js') }}\"></script>
  
  <!-- Chart JS -->
  <script src=\"{{ asset('assets/js/charts/jquery.flot.min.js') }}\"></script>
  <script src=\"{{ asset('assets/js/charts/jquery.flot.pie.min.js') }}\"></script>
  <script src=\"{{ asset('assets/js/charts/jquery.flot.categories.min.js') }}\"></script>
  <script src=\"{{ asset('assets/js/charts/jquery.flot.stack.min.js') }}\"></script>
  <script src=\"{{ asset('assets/js/charts/chart.min.js') }}\"></script>
  <script src=\"{{ asset('assets/js/charts/chartist.min.js') }}\"></script>
  <script src=\"{{ asset('assets/js/charts/chartist-data.js') }}\"></script>
  <script src=\"{{ asset('assets/js/charts/demo.js') }}\"></script>
  
  <!-- Maps JS -->
  <script src=\"{{ asset('assets/js/maps/jquery-jvectormap-2.0.2.min.js') }}\"></script>
  <script src=\"{{ asset('assets/js/maps/jquery-jvectormap-world-mill-en.js') }}\"></script>
  <script src=\"{{ asset('assets/js/maps/jvector-maps.js') }}\"></script>
  
  <!-- Calendar JS -->
  <script src=\"{{ asset('assets/js/calendar/bootstrap_calendar.js') }}\"></script>
  <script src=\"{{ asset('assets/js/calendar/demo.js') }}\"></script>
  
  <!-- Nice Select -->
  <script src=\"{{ asset('assets/js/jquery.nice-select.min.js') }}\"></script>
  
  <!-- Custom JS -->
  <script src=\"{{ asset('assets/js/custom.js') }}\"></script>
  
  <script>
    // Nice select initialization
    \$(document).ready(function() {
      \$('.bulk-actions').niceSelect();
    });
  </script>
</body>
</html>", "back_base.html.twig", "C:\\Users\\user\\Desktop\\symfonyfareszakrawicrud\\hamhama\\templates\\back_base.html.twig");
    }
}
