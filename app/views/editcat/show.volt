{% extends "layouts\base.volt" %}

{% block title %}Cat's List{% endblock %}


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
            {% if c.last_up==null %}
                   <div id="edit">  <b>{{ this.flash.outputMessage('errorf', ' (NEW!)') }} </b></div>
                {% endif %}
              <div class="card-body">
                
                <img src={{c.photo}} style="height:30%;display: block; margin-left: auto; margin-right: auto;">
                <h4 class="card-title">{{c.name_cat}}</h4>
                {{ c.type_cat ~' ( '~c.age~' ) '~' - '~c.gender }}<br/>
                {{ 'Suffers: '~c.penyakit }} <br/>                
                {{ c.condition_cat }} <br/>
                {{ "founded by: " ~c.founder ~', ' ~c.date_found~' in '~c.loc_found }}</p>
                <form method='GET' action='edit'>
                  <input type='hidden' name='id_cat' value={{c.id_cat}} >
                    <div style='display:inline-block'>
                      <button type='button' class='ad-btn btn btn-danger' id={{c.id_cat}} value={{c.id_cat}} data-toggle='modal' data-target='#delModal'>Delete</button>
                      <input type='submit' value='Edit' class='btn btn-info'>        
                    </div>
                </form>
                <p class="card-text">
                  <small class="text-muted">Last updated {{ c.last_up }}</small>
                </p>
              </div>
            </div>
          </div>
        {% endfor %}
      </div>
</div>
      <div class="container" >
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
      <div class="modal" id="delModal" role="dialog">
          <div class="modal-dialog">

              <!-- Modal content-->
              <form id='form-adopt' action='editcat' method='POST'>
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Cat's Adoption</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                            <input type='hidden' value='' name='id_cat' id='id_cat'>
                            <p>The deletion is done if only the cat has died.</p>
                            <p>Are you sure want to delete this cat?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                        <input type='submit'  name='delete' value="Delete" class='btn btn-danger'>
                    </div>
                </div>
              </form>
          </div>
      </div>
</div>

{% endblock %}