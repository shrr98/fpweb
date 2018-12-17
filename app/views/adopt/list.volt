{% extends "layouts\base.volt" %}

{% block title %}Cat's Adoption{% endblock %}

{% block content %}
<div class='container' id='donation-list' style="margin:100px 200px">
  <h1>Adoption List</h1>

  {% if adopts.count() <= 0 %}
    <h4 style="color:red;">There is no adoption</h4>
  
  {% else %}
  
    {% set iter = 1 %}
    <table class="table">
      <thead>
        <th>No</th>
        <th>Id Cat</th>
        <th>Adopter</th>
        <th>Date of Adoption</th>
      </thead>
    {% for adopt in adopts %}
      <tr>
        <td>{{iter}}</td>
        <td>{{adopt.id_cat}}</td>
        <td>{{adopt.adopter}}</td>
        <td>{{adopt.date_adopt}}</td>
      </tr>
      {% set iter+=1 %}
      {% endfor %}
    </table>
    {% endif %}
</div>

{% endblock %}