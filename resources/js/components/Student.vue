<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title float-left">Students' Details</h3>
                        <div class="card-tools">
                            <button class="btn btn-success float-right" @click="newModal">Add New </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">First name</th>
                                <th scope="col">Last name</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Teacher</th>
                                <th scope="col">Class</th>
                                <th scope="col">Joined</th>
                                <th scope="col">Modify</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="student in students.data" :key="student.id">
                                <th scope="row">{{ student.id }}</th>
                                <td>{{ student.first_name }}</td>
                                <td>{{ student.last_name }}</td>
                                <td>{{ student.gender }}</td>
                                <td>{{ student.teacher_id == 1 ? 'Emily' : 'Isabella'  }}</td>
                                <td>{{ student.classroom_id == 1 ? 'A' : student.classroom_id == 2 ? 'B' : 'C' }}</td>
                                <td>{{ student.joined_year }}</td>
                                <td>
                                    <a href="#" @click="editModal(student)">edit</a>/
                                    <a href="#" @click="deleteStudent(student.id)">Trash</a>
                                </td>
                                </tr>
                             </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

            <!-- Modal -->
            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" v-show="!editmode" id="addModalLabel">Register Student</h5>
                <h5 class="modal-title" v-show="editmode" id="updateModalLabel">Update Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="editmode ? updateStudent() : createStudent()">
                <div class="modal-body">

                    <div class="form-group">
                    <label>First Name</label>
                    <input v-model="form.first_name" type="text" name="first_name"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('first_name') }">
                    <has-error :form="form" field="first_name"></has-error>
                    </div>

                    <div class="form-group">
                    <label>Last Name</label>
                    <input v-model="form.last_name" type="last_name" name="last_name"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('last_name') }">
                    <has-error :form="form" field="last_name"></has-error>
                    </div>

                    <div class="form-group">
                    <label>Gender</label>
                    <select v-model="form.gender" name="gender" class="form-control" :class="{ 'is-invalid': form.errors.has('gender') }">
                        <option value="" disabled selected>Gender</option>
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                    </select>
                    <has-error :form="form" field="gender"></has-error>
                    </div>

                    <div class="form-group">
                    <label>Teacher</label>
                    <select v-model.number="form.teacher_id" type="text" name="teacher_id"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('teacher_id') }">
                        <option v-for="Teacher_opt in Teacher_opts" :value="Teacher_opt.id" :key="Teacher_opt.id">
                            {{ Teacher_opt.text }}
                        </option>
                    </select>

                    <has-error :form="form" field="teacher_id"></has-error>
                    </div>

                    <div class="form-group">
                    <label>Classroom</label>
                    <select v-model.number="form.classroom_id" type="text" name="classroom_id"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('classroom_id') }">
                        <option v-for="Classroom_opt in Classroom_opts" :value="Classroom_opt.id" :key="Classroom_opt.id">
                            {{ Classroom_opt.text }}
                        </option>
                    </select>
                    <has-error :form="form" field="classroom_id"></has-error>
                    </div>

                    <div class="form-group">
                    <label>Joined Year</label>
                    <select class="form-control" v-model.number="form.joined_year" name="joined_year" :class="{ 'is-invalid': form.errors.has('joined_year') }">
                        <option value="" disabled selected>Joined Year</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                    </select>
                    <has-error :form="form" field="joined_year"></has-error>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
                </div>
                 </form>
                </div>
            </div>
            </div><!-- Modal close-->
    </div>

</template>

<script>
    export default {
        data() {
            return {
                editmode:false,
                form: new Form ({
                    id: '',
                    first_name: '',
                    last_name : '',
                    gender: '',
                    teacher_id: '',
                    classroom_id: '',
                    joined_year: '',
                }),
                Teacher_opts: [
                        { text: 'Emily', id: 1 },
                        { text: 'Isabella', id: 2 },
                    ],
                Classroom_opts: [
                    { text: 'A', id: 1 },
                    { text: 'B', id: 2 },
                    { text: 'C', id: 3 },
                ],
                students: {}
            }
        },
        methods: {
            loadStudents() {
                axios.get('api/students').then(({data}) => (this.students = data));
            },
            updateStudent(id) {
                this.$Progress.start();
                this.form.put('api/students/'+this.form.id)
                .then(()=> {
                    $('#addModal').modal('hide');
                    Swal.fire(
                    'Update!',
                    'Student record has been updated.',
                    'success'
                    )
                    this.$Progress.finish();
                    Fire.$emit('AfterCreate');
                })
                .catch(()=> {
                });
            },
            newModal() {
                this.editmode =  false;
                this.form.reset();
                $('#addModal').modal('show');
            },
            editModal(student) {
                this.editmode =  true;
                this.form.reset();
                $('#addModal').modal('show');
                this.form.fill(student);
            },
            deleteStudent(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        this.form.delete('api/students/'+id)
                            .then(()=> {
                                    Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                    )
                                Fire.$emit('AfterCreate');
                            })
                            .catch(()=> {
                                    Swal.fire('Failed!',
                                    'There was something wrong.',
                                    'warning'
                                    )
                            });
                        }
                    })
            },
            createStudent(){
                this.$Progress.start()
                this.form.post('api/students')
                .then(()=>{
                    Fire.$emit('AfterCreate');
                    Toast.fire({
                        type: 'success',
                        title: 'Student created in successfully'
                    })
                    $('#addModal').modal('hide');
                    this.$Progress.finish();
                })
                 .catch(() => {
                     Swal.fire('Failed!',
                    'There was something wrong.',
                    'warning'
                    )
                });
            }
        },
        created () {
            this.loadStudents()
            Fire.$on('AfterCreate', () => {
                this.loadStudents();
            });
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
