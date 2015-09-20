{%- macro svg_icon(icon, class='') %}
    <md-icon
            md-svg-src="{{ icon }}"
            aria-label="form icon"
            {% if class is not empty %}
                class="{{ class }}"
            {% endif %}>
    </md-icon>
{%- endmacro %}

<div class="page-signin">

    <div class="signin-header">
        <div class="container text-center">
            <section class="logo">
                <a href="#/">
                    {{ svg_icon('/img/site/icons/ic_whatshot_24px.svg', 'color-primary') }}
                </a>
            </section>
        </div>
    </div>

    <div class="main-body">
        <div class="container">
            <div class="form-container">

                <form class="form-horizontal" name="loginForm">
                    {{ form.render('username', ['ng-model': 'user.username', 'required': '']) }}
                    {{ form.render('password') }}
                    {{ form.render('remember_me') }}
                    {{ form.render('csrf', ['value': security.getToken()]) }}
                    <fieldset>
                        <div class="form-group">
                            <md-input-container md-no-float>
                                <label>{{ svg_icon('/img/site/icons/ic_person_24px.svg') }} Username</label>
                                <input ng-model="user.username" type="text" required name="User[username]">
                            </md-input-container>
                        </div>
                        <div class="form-group">
                            <md-input-container class="md-primary" md-no-float>
                                <label>{{ svg_icon('/img/site/icons/ic_lock_24px.svg') }} Password</label>
                                <input ng-model="user.password" type="text" md-minlength="6" required name="User[password]">
                                <div ng-messages="loginForm.user.password.$error">
                                    <div ng-message="required">This is required.</div>
                                    <div ng-message="md-minlength">The password must be at least 6 characters long.</div>
                                </div>
                            </md-input-container>
                        </div>
                        <div class="form-group">
                        </div>
                        <div class="form-group">
                            <md-button class="btn-width-large btn-block btn-lg md-primary md-raised">Sign in</md-button>
                        </div>
                    </fieldset>
                </form>

                <section>
                    <p class="text-center"><a href="signin.html#/pages/forgot">Forgot your password?</a></p>
                    <p class="text-center text-muted text-small">Don't have an account yet? <a href="signin.html#/pages/signup">Sign up</a></p>
                </section>

            </div>
        </div>
    </div>

</div>