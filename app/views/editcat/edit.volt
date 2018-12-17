{% extends "layouts\base.volt" %}

{% block title %}Edit Cat's Information{% endblock %}

{% block content %}

<div class='notif-blok'>
    {% if(error!='') %}
        {{ this.flash.error(error) }}
    {% endif %}
    {% if(notif!='') %}
        {{ this.flash.success(notif) }}
    {% endif %}
</div>


<div class='editcat-box' style="height:auto">
<h1 style="text-align:center">Edit Cat's Information</h1>
<div style="margin-left:4vw;"><img src={{cat.photo}} height=200px width:300px></div>

{{ form.startForm() }}
    {{ form.render('id_cat') }}
    <label  for='name_cat'>{{form.getLabel('name_cat')}} </label>
    {{ form.render('name_cat') }}

    <div class="form-row" style="display: block; color:white;">
    <label  for='type_cat'>Type: </label>
        <div class="row">

        <div class="col-md-6">
        
        <div style="display:block;">
            {{ form.render('t1') }}
            {{ form.getLabel('t1') }}
        </div>

        <div style="display:block;">
            {{ form.render('t2') }}
            {{ form.getLabel('t2') }}
        </div>
        
        <div style="display:block;">
            {{ form.render('t3') }}
            {{ form.getLabel('t3') }}
        </div>

        
        <div style="display:block;">
            {{ form.render('t4') }}
            {{ form.getLabel('t4') }}
        </div>
        </div>

        <div class="col-md-6">
        <div style="display:block;">
            {{ form.render('t5') }}
            {{ form.getLabel('t5') }}
        </div>
        
        <div style="display:block;">
            {{ form.render('t6') }}
            {{ form.getLabel('t6') }}
        </div>
        
        <div style="display:block;">
            {{ form.render('t7') }}
            {{ form.getLabel('t7') }}
        </div>

        <div style="display:block;">
            {{ form.render('t8') }}
            {{ form.getLabel('t8') }}
        </div>
        </div>
        </div>
    </div>


    <div class="form-row" style="display: block; color:white;">
        <label  for='gender'>Gender: </label>
        <div style="display:block;">
            {{ form.render('Male') }}
            {{ form.getLabel('Male') }}
        </div>

        <div style="display:block;">
            {{ form.render('Female') }}
            {{ form.getLabel('Female') }}
        </div>
    </div>


    <label  for='condition_cat'>{{form.getLabel('condition_cat')}} </label>
    {{ form.render('condition_cat') }} 

    <label  for='age'>{{form.getLabel('age')}} </label>
    {{ form.render('age') }}

    <label  for='penyakit'>{{form.getLabel('penyakit')}} </label>
    {{ form.render('penyakit') }}

    <div style="margin-top:20px;">{{ form.render('Update') }}</div>
{{ form.endForm() }}
</div>

{% endblock %}