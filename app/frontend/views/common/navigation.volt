{# begin macros #}

{%- macro profile_picture(link, class='img-circle', alt='profile picture') %}
    {% return image(link, 'alt': alt, 'class': class) %}
{%- endmacro %}

{%- macro svg_icon(icon, class='') %}
    <md-icon
            md-svg-src="{{ icon }}"
            aria-label="menu icon"
            {% if class is not empty %}
                class="{{ class }}"
            {% endif %}>
    </md-icon>
{%- endmacro %}

{# end macros #}

{# begin constants #}
{% set ripple='md-ink-ripple="#bbb"' %}
{# end constants #}

<div id="nav-wrapper" class="md-whiteframe-z2">
    <ul id="nav" data-slim-scroll="" data-collapse-nav="" data-hightlight-active="">
        <li class="navigation-profile-picture">
            <a href="#/">
                {{ profile_picture('//lorempixel.com/80/80/cats', 'img80_80 img-circle') }}
            </a>
        </li>

        <li {% if route is sameas('index') %}class="active"{% endif %}>
            <a {{ ripple }} href="{{ url() }}">
                {{ svg_icon('/img/site/icons/ic_dashboard_24px.svg') }}
                <span>Dashboard</span>
            </a>
        </li>
        <li {% if route is sameas('tasks') %}class="active"{% endif %}>
            <a {{ ripple }} href="{{ url('/tasks') }}">
                {{ svg_icon('/img/site/icons/ic_dashboard_24px.svg') }}
                <span>Tasks</span>
            </a>
            <ul>

            </ul>
        </li>
        <li {% if route is sameas('epics') %}class="active"{% endif %}>
            <a {{ ripple }} href="{{ url('/epics') }}">
                {{ svg_icon('//img/site/icons/ic_dashboard_24px.svg') }}
                <span>Epics</span>
            </a>
            <ul>

            </ul>
        </li>
        <li {% if route is sameas('projects') %}class="active"{% endif %}>
            <a {{ ripple }} href="{{ url('/projects') }}">
                {{ svg_icon('/img/site/icons/ic_dashboard_24px.svg') }}
                <span>Projects</span>
            </a>
            <ul>

            </ul>
        </li>
    </ul>
</div>