<template>
<div class="container">

    <template v-if="formularios==0">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel-body" v-if="legacySystemHTML!=''">
                  <div class="form-group row text-center">
                      <div class="col-lg-12">
                          <div v-html="legacySystemHTML"></div>
                      </div>
                  </div>
                </div>

                <div class="card" v-if="legacySystemHTML==''">
                    <div class="card-header">
                        <div class="">
                            <h4>Listado de empleados</h4>
                            <div class="card-tools text-right">
                                <button title="Refrescar listado" @click="listarEmpleados(1,buscar,criterio,sortedColumn,order)" class="btn btn-warning" ><i class="fas fa-sync"></i></button>
                                <button title="Nuevo Registro" @click="abrirModal('Empleado','registrar')" class="btn btn-primary btn-xs"><i class="fas fa-user-plus"></i>  Crear</button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-head-bg-info">
                      <thead>
                        <tr>
                            <th scope="col"><i class="fas fa-user"></i>  Nombre</th>
                            <th scope="col"><i class="fas fa-at"></i>  Email</th>
                            <th scope="col"><i class="fas fa-venus-mars"></i>  Sexo</th>
                            <th scope="col"><i class="fas fa-briefcase"></i> Área</th>
                            <th scope="col"><i class="fas fa-envelope"></i> Boletín</th>
                            <th scope="col">Modificar</th>
                            <th scope="col">Eliminar</th>
  						</tr>
                      </thead>
                      <tbody>
                        <tr v-for="Empleado in arrayEmpleado" :key="Empleado.id">
                          <td v-text="Empleado.nombre"></td>
                          <td v-text="Empleado.email"></td>
                          <td>
                              <span v-if="Empleado.sexo=='M'">
                                  Masculino
                              </span>
                              <span v-else>
                                  Femenino
                              </span>
                          </td>
                          <td v-text="Empleado.area.nombre"></td>
                          <td>
                              <span v-if="Empleado.boletin==1">
                                  Si
                              </span>
                              <span v-else>
                                  No
                              </span>
                          </td>
                          <td>
                              <span>
                              <button type="button" data-toggle="tooltip" data-placement="top" title="Editar Registro" @click="abrirModal('Empleado','actualizar',Empleado)" class="btn btn-sm btn-icon btn-round btn-info">
                              <i class="fas fa-edit"></i>
                              </button>
                              </span>
                            </td>
                            <td>
                              <span>
                              <button type="button" data-toggle="tooltip" data-placement="top" title="Eliminar Registro" @click="borrado(Empleado.id)" class="btn btn-sm btn-icon btn-round btn-info">
                              <i class="fas fa-trash-alt"></i>
                              </button>
                              </span>
                            </td>
                        </tr>
                      </tbody>
                    </table>
                    <nav class="pull-right">
                      <ul class="pagination">
                          <li class="page-item" v-if="pagination.current_page > 1">
                              <a class="page-link  btn-pty-primary" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                          </li>
                          <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                              <a class="page-link btn-pty-primary" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                          </li>
                          <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                              <a class="page-link btn-pty-primary" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                          </li>
                      </ul>
                    </nav>
                  </div>
                </div>
                </div>

            </div>
        </div>
    </template>
    <template v-if="formularios==1">
        <div class="col-md-12 mt-5">
          <div class="panel-body" v-if="legacySystemHTML!=''">
              <div class="form-group row text-center">
                  <div class="col-lg-12">
                      <div v-html="legacySystemHTML"></div>
                  </div>
              </div>
          </div>
          <div class="card" v-if="legacySystemHTML==''">

            <div class="card-header">
              <h4 class="card-title"><span v-text="tituloModal"></span></h4>
            </div>
            <div class="card-body">
              <form action="#" method="POST" id="formCreateEdit" @submit.prevent="createEditEmpleado">
                <div class="mb-3 row">
                    <label for="staticnombre" class="col-sm-2 col-form-label">Nombre completo *</label>
                    <div class="col-sm-10">
                        <input type="text" v-model="nombre" class="form-control" id="nombre" name="nombre" placeholder="Nombre Completo">
                        <p class="text-danger">{{errors.nombre}}</p>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Correo electrónico *</label>
                    <div class="col-sm-10">
                    <input type="text" v-model="email" class="form-control" id="email" name="email" placeholder="Correo electrónico">
                    <p class="text-danger">{{errors.email}}</p>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Sexo *</label>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" v-model="sexo" name="flexRadioDefault" id="flexRadioDefault1" value="M">
                            <label class="form-check-label" for="flexRadioDefault1">
                            Masculino
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" v-model="sexo" name="flexRadioDefault" id="flexRadioDefault2" value="F">
                            <label class="form-check-label" for="flexRadioDefault2">
                            Femenino
                            </label>
                        </div>
                        <p class="text-danger">{{errors.sexo}}</p>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Área *</label>
                    <div class="col-sm-10">
                        <select v-model="area" class="form-control form-control">
                            <option value="">Seleccione Área</option>
                            <option v-for="area in arrayArea" :key="area.id" :value="area.id" v-text="area.nombre"></option>
                        </select>
                        <p class="text-danger">{{errors.area}}</p>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Descripción *</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" v-model="descripcion"></textarea>
                        <p class="text-danger">{{errors.descripcion}}</p>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" v-model="boletin" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                Deseo recibir boletín informativo
                            </label>
                            <p class="text-danger">{{errors.boletin}}</p>
                        </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Roles *</label>
                    <div class="col-sm-10">
                        <div class="panel-body" v-if="legacySystemHTML2!=''">
                            <div class="form-group row text-center">
                                <div class="col-lg-12">
                                    <div v-html="legacySystemHTML2"></div>
                                </div>
                            </div>
                        </div>
                        <span  v-if="legacySystemHTML2==''">
                            <div class="form-check"  v-for="(items) in arrayRol" :key="items.id">
                                <input class="form-check-input" v-model="items.answer" :name="items.id" :id="items.id"  type="checkbox" :value="items.text">
                                <label class="form-check-label" for="defaultCheck1">
                                    {{items.text}}
                                </label>

                            </div>
                            <p class="text-danger">{{errors.rol}}</p>
                        </span>
                    </div>
                </div>



                <div class="row pull-right">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                      <div class="text-right form-animate-text">
                        <input class="submit btn btn-success" v-if="tipoAccion==1" type="submit" value="Guardar">
                        <input class="submit btn btn-info" v-if="tipoAccion==2" type="submit" value="Actualizar">
                        <input class="submit btn btn-danger" type="button" @click="cerrarFormulario()" value="Cancelar">
                      </div>
                    </div>
                </div>
              </form>
            </div>
          </div>
        </div>
    </template>
</div>
</template>

<script>
export default {
    data(){
      return{
          legacySystemHTML: '',
          legacySystemHTML2: '',
          formularios: 0,
          pagination : {
                'total' : 0,
                'current_page' : 0,
                'per_page' : 0,
                'last_page' : 0,
                'from' : 0,
                'to' : 0,
                },
            offset : 3,
            sortedColumn: 'nombre',
            order: 'asc',
            criterio : 'nombre',
            oculta: 0,
            buscar : '',
            tipoAccion : 0,
            tituloModal: '',
            arrayEmpleado: [],
            filtro1:'',
            filtro2:'',
            filtro3:'',
            filtro4:'',
            nombre: '',
            email: '',
            sexo: '',
            area: '',
            descripcion: '',
            boletin: '',
            rol: '',
            id_empleado: 0,
            arrayArea: [],
            arrayRol: [],
            errors:{
                nombre: "",
                email: "",
                sexo: "",
                area:'',
                descripcion: '',
                boletin: '',
                rol: '',
            }
      }
    },

    computed:{
        isActived: function(){
            return this.pagination.current_page;
        },
        //Calcula los elementos de la paginación
        pagesNumber: function() {
            if(!this.pagination.to) {
                return [];
            }
            var from = this.pagination.current_page - this.offset;
            if(from < 1) {
                from = 1;
            }
            var to = from + (this.offset * 2);
            if(to >= this.pagination.last_page){
                to = this.pagination.last_page;
            }
            var pagesArray = [];
            while(from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        },
    },
    methods : {
        abrirModal(modelo, accion, data = []){
                this.formularios=1;
                this.getArea();
                this.getRol();
                switch(modelo){
                    case "Empleado":
                    {
                        switch(accion){
                            case 'registrar':
                            {

                                this.formularios = 1;
                                this.tituloModal = 'Registrar Empleado';
                                this.tipoAccion = 1;
                                this.nombre='';
                                this.email='';
                                this.sexo='';
                                this.area='';
                                this.descripcion='';
                                this.boletin = '';
                                this.rol='';
                                this.activo=1;
                                break;
                            }
                            case 'actualizar':
                            {
                                this.formularios=1;
                                this.tipoAccion=2;
                                this.tituloModal='Actualizar Empleado';
                                this.id_empleado=data['id'];
                                this.nombre=data['nombre'];
                                this.email=data['email'];
                                this.sexo=data['sexo'];
                                this.area=data['area_id'];
                                this.descripcion=data['descripcion'];
                                this.boletin=data['boletin'];
                                this.rol=data['rol'];
                                break;
                            }
                        }
                    }
                }
        },
        cerrarFormulario(){
            this.formularios = 0;
            this.nombre='';
            this.email='';
            this.sexo='A';
            this.area='';
            this.descripcion='';
            this.boletin = '';
            this.rol='';
            this.errors={
                nombre: "",
                email: "",
                sexo: "",
                area:"",
                descripcion: "",
                boletin: "",
                rol: "",
            }
        },
        cambiarPagina(page,buscar,criterio,sortedColumn,order){
            let me = this;
            //Actualiza la página actual
            me.pagination.current_page = page;
            //Envia la petición para visualizar la data de esa página
            me.listarEmpleados(page,buscar,criterio,sortedColumn,order);
        },
        borrado(id){
            this.legacySystemHTML='<center> <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></center>';
            this.$swal({
                title: 'Esta seguro de eliminar el registro?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ok',
                text: 'Esta opción no tiene forma de recuperar los datos',
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.post("/Empleado/delete",{
                                'id': id,
                                }).then((res)=>{
                                    this.legacySystemHTML='';
                                    this.$swal({
                                        icon: res.data.icon,
                                        title: res.data.title,
                                        text: res.data.message,
                                        });
                                    this.formularios = 0;
                                    this.listarEmpleados(1,'','nombre',this.sortedColumn,this.order);
                            });
                    }else{
                        this.legacySystemHTML='';
                    }
                });
        },
        getArea(){
            let me=this;
            var url= '/Area/getArea';
            axios.get(url).then(function (response) {
                var respuesta= response.data;
                me.arrayArea = respuesta.consulta;
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        getRol(){
            let me=this;
             me.legacySystemHTML2='<center> <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></center>';
            var url= '/Rol/getRol';
             me.arrayRol=[];
            axios.get(url).then(function (response) {
                var respuesta= response.data;
                //me.arrayRol = respuesta.consulta;


                    for (let key in respuesta.consulta) {
                        me.arrayRol.push({
                            id: respuesta.consulta[key].id,
                            text: respuesta.consulta[key].nombre,
                            answer: '',
                        })
                    }

                me.legacySystemHTML2 = '';
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        listarEmpleados(page,buscar,criterio,sortedColumn,order){
            let me=this;
            me.legacySystemHTML='<center> <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></center>';

            var filtro1 = me.nombre;
            var filtro2 = me.documento;
            var filtro3 = me.empresa;
            var filtro4 = me.email;

            var url= '/Empleado/listado?page=?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio+'&column='+sortedColumn+'&order='+order+'&filtro1='+filtro1+'&filtro2='+filtro2+'&filtro3='+filtro3+'&filtro4='+filtro4;
            axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayEmpleado = respuesta.listado.data;
                    me.pagination= respuesta.pagination;
                    me.legacySystemHTML=''
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        createEditEmpleado(){

            this.errors={
                nombre: "",
                email: "",
                sexo: "",
                area:"",
                descripcion: "",
                boletin: "",
                rol: "",
            }

            this.legacySystemHTML='<center> <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></center>';

            if (this.id_empleado>0) {
                axios.post("/Empleado/update",{
                    'id_empleado': this.id_empleado,
                    'nombre': this.nombre,
                    'email': this.email,
                    'sexo': this.sexo,
                    'area': this.area,
                    'descripcion': this.descripcion,
                    'boletin': this.boletin,
                    'arrayRol': this.arrayRol,
                })
                .then((res) => {
                    if (res.data.status=="success") {
                    this.$swal({
                        icon: res.data.icon,
                        title: res.data.title,
                        text: res.data.message,
                        });
                    this.formularios = 0;
                    this.listarEmpleados(1,'','nombre',this.sortedColumn,this.order);
                    this.legacySystemHTML = '';
                    }
                }).catch( error => {
                if(error.response.status == 422){
                    this.legacySystemHTML = '';
                    this.errors = {
                    nombre: error.response.data.nombre,
                    sexo: error.response.data.sexo,
                    email: error.response.data.email,
                    area: error.response.data.area,
                    descripcion:error.response.data.descripcion,
                    boletin:error.response.data.boletin,
                    rol:error.response.data.rol,
                    }
                }
                });
            } else {
                //axios.post("/Empleado/store",formData).then((res) => {
                axios.post("/Empleado/store",{
                    'nombre': this.nombre,
                    'email': this.email,
                    'sexo': this.sexo,
                    'area': this.area,
                    'descripcion': this.descripcion,
                    'boletin': this.boletin,
                    'arrayRol': this.arrayRol,
                }).then((res) => {
                    if (res.data.status=="success") {
                        this.$swal({
                            icon: res.data.icon,
                            title: res.data.title,
                            text: res.data.message,
                            });
                        this.formularios = 0;
                        this.listarEmpleados(1,'','nombre',this.sortedColumn,this.order);
                        this.legacySystemHTML = '';
                    }else if(res.data.status=="warning"){
                        this.$swal({
                            icon: res.data.icon,
                            title: res.data.title,
                            text: res.data.message,
                            });
                        this.formularios = 0;
                        this.legacySystemHTML = '';
                    }
                }).catch( error => {
                if(error.response.status == 422){
                    this.legacySystemHTML = '';
                    this.errors = {
                    nombre: error.response.data.nombre,
                    sexo: error.response.data.sexo,
                    email: error.response.data.email,
                    area: error.response.data.area,
                    descripcion:error.response.data.descripcion,
                    boletin:error.response.data.boletin,
                    rol:error.response.data.rol,
                    }
                }
                });
            }
        },

    },
    mounted() {
        this.listarEmpleados(1,this.buscar,this.criterio,this.sortedColumn,this.order);
    }
}
</script>
