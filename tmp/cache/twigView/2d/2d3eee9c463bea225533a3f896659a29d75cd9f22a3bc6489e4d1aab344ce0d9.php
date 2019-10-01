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

/* C:\xampp\htdocs\git\op-appv2\vendor\cakephp\bake\src\Template\Bake\Element\Controller/add.twig */
class __TwigTemplate_33e30123c104f3d86b01cb57b0022fb9bfdd430b0f58e8195f50ca3003ac2cea extends \Twig\Template
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
        $context["compact"] = [0 => (("'" . ($context["singularName"] ?? null)) . "'")];
        // line 17
        echo "    /**
     * Add method
     *
     * @return \\Cake\\Http\\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        \$";
        // line 24
        echo twig_escape_filter($this->env, ($context["singularName"] ?? null), "html", null, true);
        echo " = \$this->";
        echo twig_escape_filter($this->env, ($context["currentModelName"] ?? null), "html", null, true);
        echo "->newEntity();
        if (\$this->request->is('post')) {
            \$";
        // line 26
        echo twig_escape_filter($this->env, ($context["singularName"] ?? null), "html", null, true);
        echo " = \$this->";
        echo twig_escape_filter($this->env, ($context["currentModelName"] ?? null), "html", null, true);
        echo "->patchEntity(\$";
        echo twig_escape_filter($this->env, ($context["singularName"] ?? null), "html", null, true);
        echo ", \$this->request->getData());
            if (\$this->";
        // line 27
        echo twig_escape_filter($this->env, ($context["currentModelName"] ?? null), "html", null, true);
        echo "->save(\$";
        echo twig_escape_filter($this->env, ($context["singularName"] ?? null), "html", null, true);
        echo ")) {
                \$this->Flash->success(__('The ";
        // line 28
        echo twig_escape_filter($this->env, twig_lower_filter($this->env, ($context["singularHumanName"] ?? null)), "html", null, true);
        echo " has been saved.'));

                return \$this->redirect(['action' => 'index']);
            }
            \$this->Flash->error(__('The ";
        // line 32
        echo twig_escape_filter($this->env, twig_lower_filter($this->env, ($context["singularHumanName"] ?? null)), "html", null, true);
        echo " could not be saved. Please, try again.'));
        }
";
        // line 34
        $context["associations"] = $this->getAttribute(($context["Bake"] ?? null), "aliasExtractor", [0 => ($context["modelObj"] ?? null), 1 => "BelongsTo"], "method");
        // line 35
        $context["associations"] = twig_array_merge(($context["associations"] ?? null), $this->getAttribute(($context["Bake"] ?? null), "aliasExtractor", [0 => ($context["modelObj"] ?? null), 1 => "BelongsToMany"], "method"));
        // line 37
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["associations"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["assoc"]) {
            // line 38
            $context["otherName"] = $this->getAttribute(($context["Bake"] ?? null), "getAssociatedTableAlias", [0 => ($context["modelObj"] ?? null), 1 => $context["assoc"]], "method");
            // line 39
            $context["otherPlural"] = Cake\Utility\Inflector::variable(($context["otherName"] ?? null));
            // line 40
            echo "        \$";
            echo twig_escape_filter($this->env, ($context["otherPlural"] ?? null), "html", null, true);
            echo " = \$this->";
            echo twig_escape_filter($this->env, ($context["currentModelName"] ?? null), "html", null, true);
            echo "->";
            echo twig_escape_filter($this->env, ($context["otherName"] ?? null), "html", null, true);
            echo "->find('list', ['limit' => 200]);";
            // line 41
            echo "
";
            // line 42
            $context["compact"] = twig_array_merge(($context["compact"] ?? null), [0 => (("'" . ($context["otherPlural"] ?? null)) . "'")]);
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['assoc'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 44
        echo "        \$this->set(compact(";
        echo twig_join_filter(($context["compact"] ?? null), ", ");
        echo "));
    }
";
    }

    public function getTemplateName()
    {
        return "C:\\xampp\\htdocs\\git\\op-appv2\\vendor\\cakephp\\bake\\src\\Template\\Bake\\Element\\Controller/add.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  103 => 44,  97 => 42,  94 => 41,  86 => 40,  84 => 39,  82 => 38,  78 => 37,  76 => 35,  74 => 34,  69 => 32,  62 => 28,  56 => 27,  48 => 26,  41 => 24,  32 => 17,  30 => 16,);
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
{% set compact = [\"'#{singularName}'\"] %}
    /**
     * Add method
     *
     * @return \\Cake\\Http\\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        \${{ singularName }} = \$this->{{ currentModelName }}->newEntity();
        if (\$this->request->is('post')) {
            \${{ singularName }} = \$this->{{ currentModelName }}->patchEntity(\${{ singularName }}, \$this->request->getData());
            if (\$this->{{ currentModelName }}->save(\${{ singularName }})) {
                \$this->Flash->success(__('The {{ singularHumanName|lower }} has been saved.'));

                return \$this->redirect(['action' => 'index']);
            }
            \$this->Flash->error(__('The {{ singularHumanName|lower }} could not be saved. Please, try again.'));
        }
{% set associations = Bake.aliasExtractor(modelObj, 'BelongsTo') %}
{% set associations = associations|merge(Bake.aliasExtractor(modelObj, 'BelongsToMany')) %}

{%- for assoc in associations %}
    {%- set otherName = Bake.getAssociatedTableAlias(modelObj, assoc) %}
    {%- set otherPlural = otherName|variable %}
        \${{ otherPlural }} = \$this->{{ currentModelName }}->{{ otherName }}->find('list', ['limit' => 200]);
        {{- \"\\n\" }}
    {%- set compact = compact|merge([\"'#{otherPlural}'\"]) %}
{% endfor %}
        \$this->set(compact({{ compact|join(', ')|raw }}));
    }
", "C:\\xampp\\htdocs\\git\\op-appv2\\vendor\\cakephp\\bake\\src\\Template\\Bake\\Element\\Controller/add.twig", "C:\\xampp\\htdocs\\git\\op-appv2\\vendor\\cakephp\\bake\\src\\Template\\Bake\\Element\\Controller/add.twig");
    }
}
