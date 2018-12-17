{% extends "layouts\base.volt" %}

{% block title %}Donation{% endblock %}

{% block content %}
<div class='container' id='donation-list' style="margin:100px 200px">
  <h1>Donation List</h1>

  {% if donations == null %}
    <h4>There is no donation</h4>
  
  {% else %}
  
    {% set iter = 1 %}
    <table class="table table-hover table-bordered">
      <thead>
        <th>No</th>
        <th>Id Cat</th>
        <th>Donator</th>
        <th>Date of Donation</th>
        <th>Amount</th>
      </thead>
    {% for donate in donations %}
      <tr>
        <td>{{iter}}</td>
        <td>{{donate.id_cat}}</td>
        <td>{{donate.donator}}</td>
        <td>{{donate.date_donation}}</td>
        <td>{{donate.nominal}}</td>
      </tr>
      {% set iter+=1 %}
      {% endfor %}
    </table>
    {% endif %}
</div>

{% endblock %}