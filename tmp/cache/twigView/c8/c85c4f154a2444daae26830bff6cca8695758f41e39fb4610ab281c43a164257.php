<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* C:\xampp\htdocs\git\op-appv2\vendor\cakephp\bake\src\Template\Bake\Element\Controller/index.twig */
class __TwigTemplate_43014079e206c8dd66b2645fb305cf56e21ab76f2b37979835f8243b29ce2e00 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 16
        echo "    /**
     * Index method
     *
     * @return \\Cake\\Http\\Response|null
     */
    public function index()
    {
";
        // line 23
        $context["belongsTo"] = $this->getAttribute(($context["Bake"] ?? null), "aliasExtractor", [0 => ($context["modelObj"] ?? null), 1 => "BelongsTo"], "method");
        // line 24
        if (($context["belongsTo"] ?? null)) {
            // line 25
            echo "        \$this->paginate = [
            'contain' => [";
            // line 26
            echo $this->getAttribute(($context["Bake"] ?? null), "stringifyList", [0 => ($context["belongsTo"] ?? null), 1 => ["indent" => false]], "method");
            echo "]
        ];
";
        }
        // line 29
        echo "        \$";
        echo twig_escape_filter($this->env, ($context["pluralName"] ?? null), "html", null, true);
        echo " = \$this->paginate(\$this->";
        echo twig_escape_filter($this->env, ($context["currentModelName"] ?? null), "html", null, true);
        echo ");

        \$this->set(compact('";
        // line 31
        echo twig_escape_filter($this->env, ($context["pluralName"] ?? null), "html", null, true);
        echo "'));
    }
";
    }

    public function getTemplateName()
    {
        return "C:\\xampp\\htdocs\\git\\op-appv2\\vendor\\cakephp\\bake\\src\\Template\\Bake\\Element\\Controller/index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  60 => 31,  52 => 29,  46 => 26,  43 => 25,  41 => 24,  39 => 23,  30 => 16,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{#
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         2.0.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
#}
    /**
     * Index method
     *
     * @return \\Cake\\Http\\Response|null
     */
    public function index()
    {
{% set belongsTo = Bake.aliasExtractor(modelObj, 'BelongsTo') %}
{% if belongsTo %}
        \$this->paginate = [
            'contain' => [{{ Bake.stringifyList(belongsTo, {'indent': false})|raw }}]
        ];
{% endif %}
        \${{ pluralName }} = \$this->paginate(\$this->{{ currentModelName }});

        \$this->set(compact('{{ pluralName }}'));
    }
", "C:\\xampp\\htdocs\\git\\op-appv2\\vendor\\cakephp\\bake\\src\\Template\\Bake\\Element\\Controller/index.twig", "C:\\xampp\\htdocs\\git\\op-appv2\\vendor\\cakephp\\bake\\src\\Template\\Bake\\Element\\Controller/index.twig");
    }
}
