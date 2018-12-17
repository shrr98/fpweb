{% extends "layouts\base.volt" %}

{% block title %}Profile{% endblock %}

{% block content %}
<div class="row" style="margin-left:20vw; margin-top:-285px">
<div class="col-md-6">
<div class='notif-blok'>
    {% if(messages['warning']!='') %}
        {{ this.flash.outputMessage('notice', messages['warning']) }}
    {% endif %}
    {% if(messages['error']!='') %}
        {{ this.flash.error(messages['error']) }}
    {% endif %}
    {% if(messages['success']!='') %}
        {{ this.flash.success(messages['success']) }}
    {% endif %}
</div>

<div class='profile-box'>
    <h1>YOUR PROFILE</h1>
    <div class='container'>
        <div>
            <a href='data:image/png;base64,{{user.photo}}{{"'/download="}} {{this.session.get('auth')['username']}} {{".png"}}>
                <img width=300px src=data:image/png;base64,{{user.photo}}>
            </a>

            <img src="img/edit_icon.png" type='button' id='edit_photo' data-toggle='modal' data-target='#myModal' style="position:sticky;">

        </div>
        <div class="modal" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Upload Profile Picture</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form id='form-photo' action='save_photo' method='post' enctype="multipart/form-data">
                            {{ upload.render('photo') }}
                            {% if(messages['photo']!='') %}
                                {{ this.flash.outputMessage('errorf', messages['photo']) }}
                            {% endif %}

                            {{ upload.render('Save') }}
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <div id='info-name' class='info' style="display:inline-block">
        <h3><b>{{ user.name }}</b></h3>
            <img src="img/edit_icon.png" type='button' id='edit_name' class='edit-icon'>
    </div>
    <form id='form-name' class='profile-form' action='save_name' method='POST'>
        {{ profile.render('name') }}
        {% if(messages['name']!='') %}
            {{ this.flash.outputMessage('errorf', messages['name']) }}
        {% endif %}
        
        <button type='button' id='close-name' class='btn btn-danger'>
            Cancel
        </button>
        {{ profile.render('Save') }}
    </form>

    <div class='info'>
        <h4>Account Info</h4>
        <img src="img/edit_icon.png" type='button' id='edit_account' class='edit-icon' style="margin-left:-5vw;">
    </div>
    <div id='info-account' class='info'>
        <table>
            <tr>
                <td>Username:</td>
                <td>{{ '@'~user.username }}</td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>{{ user.email }}</td>
            </tr>
            <tr>
                <td>Phone:</td>
                <td>{{ user.phone }}</td>
            </tr>
        </table>
    </div>

    <div id='form-account' class='profile-form'>
        <form action='save_account' method='POST'>
            {{ profile.render('username') }}
            {% if(messages['username']!='') %}
                {{ this.flash.outputMessage('errorf', messages['username']) }}
            {% endif %}

            {{ profile.render('email') }}
            {% if(messages['email']!='') %}
                {{ this.flash.outputMessage('errorf', messages['email']) }}
            {% endif %}

            {{ profile.render('phone') }}
            {% if(messages['phone']!='') %}
                {{ this.flash.outputMessage('errorf', messages['phone']) }}
            {% endif %}
            <button type='button' id='close-account' class='btn btn-danger'>
                Cancel
            </button>
            {{ profile.render('Save') }}

        </form>
    </div>

    <div class='info-privacy'>
        <h4>Privacy</h4>
        <button type='button' id='edit_privacy' class='btn btn-primary' data-toggle='modal' data-target='#pwModal'>
            Change Password
        </button>
    </div>

    <div id="privacy" class='container'>
        <div class="modal" id="pwModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Change Password</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form id='form-password' action='save_password' method='post'>
                            {{ profile.render('password') }}
                            {% if(messages['password']!='') %}
                                {{ this.flash.outputMessage('errorf', messages['password']) }}
                            {% endif %}

                            {{ profile.render('confirmp') }}
                            {% if(messages['confirmp']!='') %}
                                {{ this.flash.outputMessage('errorf', messages['confirmp']) }}
                            {% endif %}

                            {{ profile.render('Save') }}
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="col-md-6">
<div class="id" style="height:200px; width:400px; overflow-y:scroll; display:block;">
    {% if user_notif==null %}
        {{ this.flash.error('There is no notification') }}
    {% else %}
    {%for notif in user_notif %}
        {{ this.flash.notice(notif.msg ~ '     [' ~ notif.date_notif ~ ']')}}
        <a href='see?id_notif={{notif.id_notif}}'>See Details</a>
    {%endfor%}
    {% endif %}
</div>
</div>
</div>

{% endblock %}