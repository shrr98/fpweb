{% extends "layouts\base.volt" %}

{% block title %}Adopt a Cat{% endblock %}

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
                <img src={{c.photo}} style="height:30%;display: block; margin-left: auto; margin-right: auto;">
                <h4 class="card-title">{{c.name_cat}}</h4>
                {{ c.type_cat ~' ( '~c.age~' ) '~' - '~c.gender }}<br/>
                {{ 'Suffers: '~c.penyakit }} <br/>                
                {{ c.condition_cat }} <br/>
                {{ "founded by: " ~c.founder ~', ' ~c.date_found~' in '~c.loc_found }}</p>
                <button type='button' class='ad-btn btn btn-info' id={{c.id_cat}} value={{c.id_cat}} data-toggle='modal' data-target='#adModal'>Adopt Me!</button>
                <p class="card-text">
                  <small class="text-muted">Last updated {{ c.last_up }}</small>
                </p>
              </div>
            </div>
          </div>
        {% endfor %}
      </div>
          </div>
      <div class="container">
        <div class="row" style="top:88%; height:35px;">
          <div class="col-12 text-center mt-4" style="display:block;">
            <a class="btn btn-outline-secondary mx-1 prev" href="javascript:void(0)" title="Previous">
              <i class="fa fa-lg fa-chevron-left"></i>
            </a>
            <a class="btn btn-outline-secondary mx-1 next" href="javascript:void(0)" title="Next">
              <i class="fa fa-lg fa-chevron-right"></i>
            </a>
          </div>
        </div>
      </div>

  {% else %}
    <h4>No cats found</h4>
  {% endif %}  
</div>

<div id="adoption" class='container'>
        <div class="modal" id="adModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <form id='form-adopt' action='adopt' method='post'>
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Cat's Adoption</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                            <input type='hidden' value='' name='id_cat' id='id_cat'>
                            <p>Are you sure want to adopt this cat?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <input type='submit'  name='adopt' value="I'm sure" class='btn btn-info'>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

{% endblock %}