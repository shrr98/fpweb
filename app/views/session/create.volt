{% extends "layouts\base.volt" %}

{% block title %}Login disini{% endblock %}

{% block content %}
	{{ form.startForm()}}
		<div class="form-gorup">
			{{ form.render('username') }}
			{{ this.flash.outputMessage('error', "* "~message['username'] )}}
		</div>
		
		<div class="form-gorup">
				{{ form.render('password') }}
				{{ this.flash.outputMessage('error', "* "~message['email'] )}}
		</div>
		{{ form.render('Login') }}
	{{ form.endForm() }}
	
	<a href="{{url("register")}}">Register</a>
{% endblock %}