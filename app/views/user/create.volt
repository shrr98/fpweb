{% extends "layouts\base.volt" %}

{% block title %}Daftar Disini{% endblock %}

{% block content %}

<div class="wrapper">
    <form action="register" method="POST" id="wizard">
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
							<h3>Registration to be Member</h3>
							<p >~ About Your Identity ~</p>
						</div>

						<div class="form-row">
							{{ form.startForm() }}
							<label  for='name'>{{ form.getLabel('name') }}</label>
							{{ form.render('name') }}
						</div>

						<div class="form-row" style="display: block; color:white;">
							<label  for='gender'>Which one are you? </label>
							<div style="display:block;">
								{{ form.render('Male') }}
								{{ form.getLabel('Male') }}
							</div>

							<div style="display:block;">
								{{ form.render('Female') }}
								{{ form.getLabel('Female') }}
							</div>

							<div style="display:block;">
								{{ form.render('Other') }}
								{{ form.getLabel('Other') }}
							</div>
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
					<img src="img/cat8.jpg" alt="">
				</div>
				<div class="form-content">
					<div class="form-inner">
						<div class="form-header" style="width:100%">
							<h3>Registration to be Member</h3>
							<p>~ About Your Contact ~</p>
						</div>
						<div class="form-row" style="width:100%;">
							<label  for='phone' style="display:inline-block;float:left;" >{{ form.getLabel('phone') }} {{ this.flash.outputMessage('errorf', "* "~message['phone'] )}} </label>
							{{ form.render('phone') }}
							
						</div>

						<div class="form-row" style="width:100%;">
							<label  for='email'>  {{ form.getLabel('email') }} {{ this.flash.outputMessage('errorf', "* "~message['email'] )}} </label>
							{{ form.render('email') }}
						</div>
					</div>
				</div>
			</div>
        </section>

		<!-- SECTION 3 -->
        <h4></h4>
        <section>
				<div class="inner">
				<div class="image-holder">
					<img src="img/cat8.jpg" alt="">
				</div>
				<div class="form-content">
					<div class="form-inner">
						<div class="form-header" style="width:100%">
							<h3>Registration to be Member</h3>
							<p>~ About Your Account ~</p>
						</div>
						<div class="form-row" style="width:100%;">
							<label  for='username' style="display:inline-block;float:left;" > {{ form.getLabel('username') }} {{ this.flash.outputMessage('errorf', "* "~message['username'] )}} </label>
							{{ form.render('username') }}		
						</div>

						<div class="form-row" style="width:100%;">
							<label  for='password' style="display:inline-block;float:left;" > {{ form.getLabel('password') }} {{ this.flash.outputMessage('errorf', "* "~message['password'] )}} </label>
							{{ form.render('password') }}
							
						</div>

						<div class="form-row" style="width:100%;">
							<label  for='confirmp' style="display:inline-block;float:left;" > {{ form.getLabel('confirmp') }} {{ this.flash.outputMessage('errorf', "* " ~ message['confirmp'] )}} </label>
							{{ form.render('confirmp') }}
						</div>

						<div style="float:right;">{{ form.render('Signup') }}</div>
					</div>
				</div>
			</div>
        </section>
    </form>
</div>


{% endblock %}