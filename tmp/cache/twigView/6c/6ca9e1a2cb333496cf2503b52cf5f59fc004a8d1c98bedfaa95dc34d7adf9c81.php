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

/* C:\xampp\htdocs\git\op-appv2\vendor\cakephp\bake\src\Template\Bake\Element\Controller/edit.twig */
class __TwigTemplate_eeef674b9133ac6e5a647d2e211bec6aa99524ce9129d8840ae6370f74cbd3b1 extends \Twig\Template
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
        $context["belongsTo"] = $this->getAttribute(($context["Bake"] ?? null), "aliasExtractor", [0 => ($context["modelObj"] ?? null), 1 => "BelongsTo"], "method");
        // line 17
        $context["belongsToMany"] = $this->getAttribute(($context["Bake"] ?? null), "aliasExtractor", [0 => ($context["modelObj"] ?? null), 1 => "belongsToMany"], "method");
        // line 18
        $context["compact"] = [0 => (("'" . ($context["singularName"] ?? null)) . "'")];
        // line 19
        echo "    /**
     * Edit method
     *
     * @param string|null \$id ";
        // line 22
        echo twig_escape_filter($this->env, ($context["singularHumanName"] ?? null), "html", null, true);
        echo " id.
     * @return \\Cake\\Http\\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \\Cake\\Datasource\\Exception\\RecordNotFoundException When record not found.
     */
    public function edit(\$id = null)
    {
        \$";
        // line 28
        echo twig_escape_filter($this->env, ($context["singularName"] ?? null), "html", null, true);
        echo " = \$this->";
        echo twig_escape_filter($this->env, ($context["currentModelName"] ?? null), "html", null, true);
        echo "->get(\$id, [
            'contain' => [";
        // line 29
        echo $this->getAttribute(($context["Bake"] ?? null), "stringifyList", [0 => ($context["belongsToMany"] ?? null), 1 => ["indent" => false]], "method");
        echo "]
        ]);
        if (\$this->request->is(['patch', 'post', 'put'])) {
            \$";
        // line 32
        echo twig_escape_filter($this->env, ($context["singularName"] ?? null), "html", null, true);
        echo " = \$this->";
        echo twig_escape_filter($this->env, ($context["currentModelName"] ?? null), "html", null, true);
        echo "->patchEntity(\$";
        echo twig_escape_filter($this->env, ($context["singularName"] ?? null), "html", null, true);
        echo ", \$this->request->getData());
            if (\$this->";
        // line 33
        echo twig_escape_filter($this->env, ($context["currentModelName"] ?? null), "html", null, true);
        echo "->save(\$";
        echo twig_escape_filter($this->env, ($context["singularName"] ?? null), "html", null, true);
        echo ")) {
                \$this->Flash->success(__('The ";
        // line 34
        echo twig_escape_filter($this->env, twig_lower_filter($this->env, ($context["singularHumanName"] ?? null)), "html", null, true);
        echo " has been saved.'));

                return \$this->redirect(['action' => 'index']);
            }
            \$this->Flash->error(__('The ";
        // line 38
        echo twig_escape_filter($this->env, twig_lower_filter($this->env, ($context["singularHumanName"] ?? null)), "html", null, true);
        echo " could not be saved. Please, try again.'));
        }
";
        // line 40
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_array_merge(($context["belongsTo"] ?? null), ($context["belongsToMany"] ?? null)));
        foreach ($context['_seq'] as $context["_key"] => $context["assoc"]) {
            // line 41
            $context["otherName"] = $this->getAttribute(($context["Bake"] ?? null), "getAssociatedTableAlias", [0 => ($context["modelObj"] ?? null), 1 => $context["assoc"]], "method");
            // line 42
            $context["otherPlural"] = Cake\Utility\Inflector::variable(($context["otherName"] ?? null));
            // line 43
            echo "        \$";
            echo twig_escape_filter($this->env, ($context["otherPlural"] ?? null), "html", null, true);
            echo " = \$this->";
            echo twig_escape_filter($this->env, ($context["currentModelName"] ?? null), "html", null, true);
            echo "->";
            echo twig_escape_filter($this->env, ($context["otherName"] ?? null), "html", null, true);
            echo "->find('list', ['limit' => 200]);";
            // line 44
            echo "
";
            // line 45
            $context["compact"] = twig_array_merge(($context["compact"] ?? null), [0 => (("'" . ($context["otherPlural"] ?? null)) . "'")]);
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['assoc'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 47
        echo "        \$this->set(compact(";
        echo twig_join_filter(($context["compact"] ?? null), ", ");
        echo "));
    }
";
    }

    public function getTemplateName()
    {
        return "C:\\xampp\\htdocs\\git\\op-appv2\\vendor\\cakephp\\bake\\src\\Template\\Bake\\Element\\Controller/edit.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  113 => 47,  107 => 45,  104 => 44,  96 => 43,  94 => 42,  92 => 41,  88 => 40,  83 => 38,  76 => 34,  70 => 33,  62 => 32,  56 => 29,  50 => 28,  41 => 22,  36 => 19,  34 => 18,  32 => 17,  30 => 16,);
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
{% set belongsTo = Bake.aliasExtractor(modelObj, 'BelongsTo') %}
{% set belongsToMany = Bake.aliasExtractor(modelObj, 'belongsToMany') %}
{% set compact = [\"'#{singularName}'\"] %}
    /**
     * Edit method
     *
     * @param string|null \$id {{ singularHumanName }} id.
     * @return \\Cake\\Http\\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \\Cake\\Datasource\\Exception\\RecordNotFoundException When record not found.
     */
    public function edit(\$id = null)
    {
        \${{ singularName }} = \$this->{{ currentModelName }}->get(\$id, [
            'contain' => [{{ Bake.stringifyList(belongsToMany, {'indent': false})|raw }}]
        ]);
        if (\$this->request->is(['patch', 'post', 'put'])) {
            \${{ singularName }} = \$this->{{ currentModelName }}->patchEntity(\${{ singularName }}, \$this->request->getData());
            if (\$this->{{ currentModelName }}->save(\${{ singularName }})) {
                \$this->Flash->success(__('The {{ singularHumanName|lower }} has been saved.'));

                return \$this->redirect(['action' => 'index']);
            }
            \$this->Flash->error(__('The {{ singularHumanName|lower }} could not be saved. Please, try again.'));
        }
{% for assoc in belongsTo|merge(belongsToMany) %}
    {%- set otherName = Bake.getAssociatedTableAlias(modelObj, assoc) %}
    {%- set otherPlural = otherName|variable %}
        \${{ otherPlural }} = \$this->{{ currentModelName }}->{{ otherName }}->find('list', ['limit' => 200]);
        {{- \"\\n\" }}
    {%- set compact = compact|merge([\"'#{otherPlural}'\"]) %}
{% endfor %}
        \$this->set(compact({{ compact|join(', ')|raw }}));
    }
", "C:\\xampp\\htdocs\\git\\op-appv2\\vendor\\cakephp\\bake\\src\\Template\\Bake\\Element\\Controller/edit.twig", "C:\\xampp\\htdocs\\git\\op-appv2\\vendor\\cakephp\\bake\\src\\Template\\Bake\\Element\\Controller/edit.twig");
    }
}
