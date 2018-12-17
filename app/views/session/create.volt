{% extends "layouts\base.volt" %}

{% block title %}Login disini{% endblock %}

{% block content %}

{% if cookies.has('username') %}
	
{% endif %}

<div class="row-centered">
	<div class="card"></div>
	<div class="col-md-6">
		{{ form.startForm()}}
			<div class="form-group">
			{{form.render('username') }}
			</div>
			<div class="form-group">
			{{ form.render('password') }}
			</div>
			<div class="form-group">
			{{ form.render('Login') }}
			</div>
		{{ form.endForm() }}
	</div>
	<div class="col-md-6">
	<a href="{{url("register")}}">Register</a>
	</div>
	<img src="img/cat13.png">
</div>

{% endblock %}