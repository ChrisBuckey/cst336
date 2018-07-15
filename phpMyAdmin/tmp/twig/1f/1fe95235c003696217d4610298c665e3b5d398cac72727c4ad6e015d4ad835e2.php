<?php

/* columns_definitions/transformation.twig */
class __TwigTemplate_f9b266b49d38f0b4a5393650db30bff2214a0fb2b261098acfa2fdd425608132 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<select id=\"field_";
        echo twig_escape_filter($this->env, (isset($context["column_number"]) ? $context["column_number"] : null), "html", null, true);
        echo "_";
        echo twig_escape_filter($this->env, ((isset($context["ci"]) ? $context["ci"] : null) - (isset($context["ci_offset"]) ? $context["ci_offset"] : null)), "html", null, true);
        echo "\"
    size=\"1\"
    name=\"field_";
        // line 3
        echo twig_escape_filter($this->env, (isset($context["type"]) ? $context["type"] : null), "html", null, true);
        echo "[";
        echo twig_escape_filter($this->env, (isset($context["column_number"]) ? $context["column_number"] : null), "html", null, true);
        echo "]\">
    <option value=\"\" title=\"";
        // line 4
        echo _gettext("None");
        echo "\"></option>
    ";
        // line 5
        if (($this->getAttribute((isset($context["available_mime"]) ? $context["available_mime"] : null), (isset($context["type"]) ? $context["type"] : null), array(), "array", true, true) && twig_test_iterable($this->getAttribute((isset($context["available_mime"]) ? $context["available_mime"] : null), (isset($context["type"]) ? $context["type"] : null), array(), "array")))) {
            // line 6
            echo "        ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["available_mime"]) ? $context["available_mime"] : null), (isset($context["type"]) ? $context["type"] : null), array(), "array"));
            foreach ($context['_seq'] as $context["mimekey"] => $context["transform"]) {
                // line 7
                echo "            ";
                $context["checked"] = (((($this->getAttribute((isset($context["column_meta"]) ? $context["column_meta"] : null), "Field", array(), "array", true, true) && $this->getAttribute($this->getAttribute(                // line 8
(isset($context["mime_map"]) ? $context["mime_map"] : null), $this->getAttribute((isset($context["column_meta"]) ? $context["column_meta"] : null), "Field", array(), "array"), array(), "array", false, true), (isset($context["type"]) ? $context["type"] : null), array(), "array", true, true)) && preg_match((("@" . preg_quote($this->getAttribute($this->getAttribute(                // line 10
(isset($context["available_mime"]) ? $context["available_mime"] : null), ((isset($context["type"]) ? $context["type"] : null) . "_file"), array(), "array"), $context["mimekey"], array(), "array"), "@")) . "3?@i"), $this->getAttribute($this->getAttribute(                // line 9
(isset($context["mime_map"]) ? $context["mime_map"] : null), $this->getAttribute((isset($context["column_meta"]) ? $context["column_meta"] : null), "Field", array(), "array"), array(), "array"), (isset($context["type"]) ? $context["type"] : null), array(), "array")))) ? ("selected ") : (""));
                // line 12
                echo "            ";
                $context["tooltip"] = PhpMyAdmin\Transformations::getDescription($this->getAttribute($this->getAttribute(                // line 13
(isset($context["available_mime"]) ? $context["available_mime"] : null), ((isset($context["type"]) ? $context["type"] : null) . "_file"), array(), "array"), $context["mimekey"], array(), "array"));
                // line 15
                echo "            ";
                $context["parts"] = twig_split_filter($this->env, $context["transform"], ":");
                // line 16
                echo "            ";
                $context["name"] = (((((PhpMyAdmin\Transformations::getName($this->getAttribute($this->getAttribute(                // line 17
(isset($context["available_mime"]) ? $context["available_mime"] : null), ((isset($context["type"]) ? $context["type"] : null) . "_file"), array(), "array"), $context["mimekey"], array(), "array")) . " (") . twig_lower_filter($this->env, $this->getAttribute(                // line 18
(isset($context["parts"]) ? $context["parts"] : null), 0, array(), "array"))) . ":") . $this->getAttribute((isset($context["parts"]) ? $context["parts"] : null), 1, array(), "array")) . ")");
                // line 19
                echo "            <option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["available_mime"]) ? $context["available_mime"] : null), ((isset($context["type"]) ? $context["type"] : null) . "_file"), array(), "array"), $context["mimekey"], array(), "array"), "html", null, true);
                echo "\"
                ";
                // line 20
                echo twig_escape_filter($this->env, (isset($context["checked"]) ? $context["checked"] : null), "html", null, true);
                echo "
                title=\"";
                // line 21
                echo twig_escape_filter($this->env, (isset($context["tooltip"]) ? $context["tooltip"] : null), "html", null, true);
                echo "\">
                ";
                // line 22
                echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true);
                echo "
            </option>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['mimekey'], $context['transform'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 25
            echo "    ";
        }
        // line 26
        echo "</select>
";
    }

    public function getTemplateName()
    {
        return "columns_definitions/transformation.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  87 => 26,  84 => 25,  75 => 22,  71 => 21,  67 => 20,  62 => 19,  60 => 18,  59 => 17,  57 => 16,  54 => 15,  52 => 13,  50 => 12,  48 => 9,  47 => 10,  46 => 8,  44 => 7,  39 => 6,  37 => 5,  33 => 4,  27 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "columns_definitions/transformation.twig", "/home/ubuntu/workspace/phpMyAdmin/templates/columns_definitions/transformation.twig");
    }
}
