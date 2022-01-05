<template>
  <div class="container">
    <div class="card">
      <div class="card-header">Editting Task "{{ todo.title }}"</div>
      <div class="card-body">
        <form v-on:submit.prevent="updateTodo">
          <div class="form-group">
            <label for="nombre">Title</label>
            <input
              type="text"
              class="form-control"
              name="title"
              id="title"
              required
              v-model="todo.title"
              aria-describedby="helpId"
              placeholder="Title"
            />
            <small id="helpId" class="form-text text-muted"
              >What needs to be done</small
            >
          </div>
          <div class="btn-group" role="group" aria-label="">
            <button type="submit" class="btn btn-success">Update</button>
            <router-link :to="{ name: 'TodoList' }" class="btn btn-warning"
              >Cancel</router-link
            >
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      todo: {},
    };
  },
  created: function () {
    this.getInfoById();
  },
  methods: {
    getInfoById() {
      fetch("http://localhost/todos/?consult=" + this.$route.params.id)
        .then((response) => response.json())
        .then((dataResponse) => {
          console.log(dataResponse);
          this.todo = dataResponse[0];
        })
        .catch(console.log);
    },
    updateTodo() {
      var dataSend = {
        id: this.$route.params.id,
        title: this.todo.title,
        completed: this.todo.completed,
      };
      fetch("http://localhost/todos/?update=" + this.$route.params.id, {
        method: "POST",
        body: JSON.stringify(dataSend),
      })
        .then((response) => response.json())
        .then((dataResponse) => {
          console.log(dataResponse);
          window.location.href = "../todoList";
        });
    },
  },
};
</script>