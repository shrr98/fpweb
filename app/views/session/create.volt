{% extends "layouts\base.volt" %}

{% block title %}Login disini{% endblock %}

{% block content %}


<div class='notif-blok'>
	{% if(message!='') %}
		{{ this.flash.error(message) }}
	{% endif %}
</div>


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
			<div class="form-group">
			{{ form.render('Login') }}
			</div style="margin-left:50px;">
			{{ form.render('remember') }}
			{{ form.getLabel('remember') }}
			</div>
		{{ form.endForm() }}
	</div>
	<div class="col-md-6">
	<a href="{{url("register")}}">Register</a>
	</div>
	<img src="img/cat13.png">
</div>

{% endblock %}