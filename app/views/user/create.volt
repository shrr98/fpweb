{% extends "layouts\base.volt" %}

{% block title %}Daftar Disini{% endblock %}

{% block content %}
<div class="row">
	<div class="col-md-6">
	
	{{ form.startForm() }}
		<div class="form-gorup">
			{{ form.render('username') }}
			{{ this.flash.outputMessage('error', "* "~message['username'] )}}
		</div>
		
		<div class="form-gorup">
				{{ form.render('email') }}
				{{ this.flash.outputMessage('error', "* "~message['email'] )}}
		</div>
		
		<div class="form-gorup">
				{{ form.render('password') }}
				{{ this.flash.outputMessage('error', "* "~message['password'] )}}
		</div>

		<div class="form-gorup">
				{{ form.render('confirmp') }}
				{{ this.flash.outputMessage('error', "* " ~ message['confirmp'] )}}
		</div>

		<div class="form-gorup">
				{{ form.render('phone') }}
				{{ this.flash.outputMessage('error', "* "~message['phone'] )}}
		</div>
		
		{{ form.render('Signup') }}
	{{ form.endForm() }}
	</div>
	<div class="col-md-6">
		<p>Login instead</p>
	</div>
</div>
{% endblock %}