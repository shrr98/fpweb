{% extends "layouts\base.volt" %}

{% block title %}Find a Cat{% endblock %}

{% block content %}
<div class='notif-blok'>
    {% if notif !='' %}
    {{ this.flash.success(notif) }}
    {% endif %}
    {% if error !='' %}
    {{ this.flash.error(error) }}
    {% endif %}
</div>


<div class="wrapper">
    <form action="report" method='POST' enctype='multipart/form-data' id="wizard">
        <!-- SECTION 1 -->
        <h4></h4>
        <section>
            <div class="inner">
                <div class="image-holder">
                    <img src="img/cat9.jpg" alt="">
                </div>
                <div class="form-content">
                    <div class="form-inner">
                        <div class="form-header">
                            <h3>Registration for Cat</h3>
                            <p >~ About Location and Condition ~</p>
                        </div>

                        <div class="form-row" id="big">
                            <label for='location' style="display:inline-block;float:left;"5>{{ form.getLabel('location') }}</label>
                            {{ this.flash.outputMessage('errorf', '*'~messages['location']) }}
                            {{ form.render('location') }}
                            {{ this.flash.outputMessage('errorf', messages['location']) }}
                        </div>

                        <div class="form-row" id='big'>
                            <label for='cat_condition'>{{ form.getLabel('cat_condition') }}</label>
                            {{ form.render('cat_condition') }}
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 2 -->
        <h4></h4>
        <section>
            <div class="inner">
                <div class="image-holder">
                    <img src="img/cat9.jpg" alt="">
                </div>
                <div class="form-content">
                    <div class="form-inner">
                        <div class="form-header">
                            <h3>Registration for Cat</h3>
                            <p >~ About Identity ~</p>
                        </div>
                        <div class="form-row">
                            <label for='cat_name'>{{ form.getLabel('cat_name') }}</label>
                            {{ form.render('cat_name') }}
                        </div>
                        <div class="form-row" style="display:block; color:white;">
                            <label for='gender'>What gender is the cat?</label>
                            {{ form.render('Male') }}
                            {{ form.getLabel('Male')}}
                            <div style="display:block; color:white;">
                                {{ form.render('Female') }}
                                {{ form.getLabel('Female')}}
                            </div>
                            <div style="display:block; color:white;">
                                {{ form.render('Uncertain') }}
                                {{ form.getLabel('Uncertain')}}
                            </div>
                            {{ this.flash.outputMessage('errorf', messages['gender']) }}
                        </div>
                        <div class="form-row" id="big">
                            <label for='cat_photo'>{{ form.getLabel('cat_photo') }}</label>
                            {{ form.render('cat_photo') }}
                            {{ this.flash.outputMessage('errorf', messages['cat_photo']) }}
                        </div>
                        <div style="float:right;">{{ form.render('Report') }}</div>
                    </div>
                </div>
            </div>
        </section>
    </form>
</div>

{% endblock %}