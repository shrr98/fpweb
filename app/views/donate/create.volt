{% extends "layouts\base.volt" %}

{% block title %}Daftar Disini{% endblock %}

{% block content %}

<div class="home">
	<img src="img/cat8.jpg">

	<div class="row, centered">
		{% if notif!='' %}
			{{ this.flash.success(notif) }}
		{% endif %}

		{% if error!='' %}
			{{ this.flash.error(error) }}
		{% endif %}
		<div class="col-md-6">
		


		{{ form.startForm() }}
			<div class="form-group">
				<label  for='nominal'>Your Donation:</label>
				{{ form.render('nominal') }}
				{% if messages!='' %}
					{{ this.flash.outputMessage('errorf',messages) }}
				{% endif %}
			</div>
		{{ form.render('donate') }}
		{{ form.endForm() }}
		</div>

		<div class="col-md-6">
			<p>Login instead</p>
		</div>

		<div class="donate"></div>
	</div>

	<div class="row">
		<div class="column3">
			<hr><p>"We were so excited to see that our donation made a direct and profound impact on the cat's lives of so many."</p>
			<h2>- Bella, Informatics batch 2017 -</h2><hr>
		</div>
		<div class="column3">
			<hr><p>"The report was fantastic! <br> I'm so proud!"</p>
			<h2>- Kartika, Information System batch 2017 -</h2><hr>
		</div>
		<div class="column3">
			<hr><p>"These reports make giving a joy and it helps me brag to others about the progress of feral cats in this project."</p>
			<h2>- Shintya , Informatics batch 2017 -</h2><hr>
		</div>
	</div>

	<div class="row1">
		<h2>When You Give .....</h2>
		<p>Here's what you'll get</p>
		<div class="row">
			<div class="column3">
				<div class="card" style="background-color:#ccffb2;">
					<h3>Receive Notification</h3>
    				<p>You'll receive an notification <p>about updated news of cat</p></p>
				</div>
			</div>
			<div class="column3">
				<div class="card" style="background-color:#f5c1ff;">
					<h3>Group Discussion</h3>
    				<p>You can discuss about cats with other people</p>
				</div>
			</div>
			<div class="column3">
				<div class="card" style="background-color:#feff9e;">
					<h3></h3>
    				<p>You'll receive an notification about new cat</p>
				</div>
			</div>
		</div>
	</div>
</div>

{% endblock %}