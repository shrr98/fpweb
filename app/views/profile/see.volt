{% extends "layouts\base.volt" %}

{% block title %}View Cat{% endblock %}

{% block content %}
<div class="profile-box" style="padding-top:5.5vw; margin-top:3vw; background-color:#49ab81">
    {% if cat==null %}
        {{ this.flash.error("Sorry, the cat's info has been deleted :(") }}
    {% else %}
        <img src={{cat.photo}} height=200px>
        <h4><b>{{cat.name_cat}}</b></h4>
        <p>{{ cat.type_cat ~' ( '~cat.age~' ) '~' - '~cat.gender }}<br>
        {{ 'Suffers: '~cat.penyakit }}<br>
        {{ cat.condition_cat }}<br>
        {{ "founded by: " ~cat.founder ~', ' ~cat.date_found~' in '~cat.loc_found }}<br>
        </p>
        {% if cat.isadopt==1 %}
            {{ this.flash.success('ADOPTED') }}
        {% endif %}

        <a href='profile'><button style="background-color:#baffc9; color:black; width:15vw;">Back to Profile</button></a>
    {% endif %}
</div>
{% endblock %}