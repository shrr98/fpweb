{% extends "layouts\base.volt" %}

{% block title %}Donate for Cats!{% endblock %}

{% block content %}

<div class='notif-blok'>
    {% if success !='' %}
        {{ this.flash.success(success) }}
    {% endif %}
    {% if error !='' %}
        {{ this.flash.error(error) }}
    {% endif %}
</div>

<div class="container-fluid">
  {% if countcat >0 %}
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner row w-100 mx-auto 0" role="listbox" style=" width:100%; height:50vw">
        {% for c in cats %}
          {% if (loop.first) %}
          <div class="carousel-item col-md-4 active">
          {% else %}
          <div class="carousel-item col-md-4">  
          {% endif %}        
            <div class="card h-75">
              <div class="card-body">
                <img src={{c.photo}} height=200px>
                <h4 class="card-title">{{c.name_cat}}</h4>
                {{ c.type_cat ~' ( '~c.age~' ) '~' - '~c.gender }}<br/>
                {{ 'Suffers: '~c.penyakit }} <br/>                
                {{ c.condition_cat }} <br/>
                {{ "founded by: " ~c.founder ~', ' ~c.date_found~' in '~c.loc_found }}
                
                <button type='button' class='btn btn-info ad-btn' id={{c.id_cat}} value={{c.id_cat}} data-toggle='modal' data-target='#donModal'>Donate For Me!</button>
                <p class='card-text'>
                  <small class="text-muted">Last updated {{ c.last_up }}</small>
                </p>
              </div>
            </div>
          </div>
        {% endfor %}
      </div>
      <div class="container">
        <div class="row">
          <div class="col-12 text-center mt-4">
            <a class="btn btn-outline-secondary mx-1 prev" href="javascript:void(0)" title="Previous">
              <i class="fa fa-lg fa-chevron-left"></i>
            </a>
            <a class="btn btn-outline-secondary mx-1 next" href="javascript:void(0)" title="Next">
              <i class="fa fa-lg fa-chevron-right"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  {% else %}
    <h4>No cats found</h4>
  {% endif %}  
</div>

<div id="adoption" class='container'>
        <div class="modal" id="donModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <form action='care' method='POST'>
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Donate For Cate</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                            {{ form.render('id_cat') }}
                            <label for='nominal'>{{ form.getLabel('nominal') }}</label>
                            {{ form.render('nominal') }}
                            <p>Are you sure want to give donation for this cat?</p>
                    </div>
                    <div class="modal-footer">
                        {{ form.render('donate') }}
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

{% endblock %}