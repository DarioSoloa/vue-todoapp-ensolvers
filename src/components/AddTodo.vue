<template>
  <div class="container">
    <div class="card">
      <div class="card-header">Add a new To-do</div>
      <div class="card-body">
        <form v-on:submit.prevent="addTodo">
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
            />
            <small id="helpId" class="form-text text-muted"
              >What needs to be done</small
            >
          </div>
          <div class="btn-group" role="group" aria-label="">
            <button type="submit" class="btn btn-success">Add</button>
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
  methods: {
    addTodo() {
      console.log(this.todo);
      var dataSend = {
        title: this.todo.title,
      };
      fetch("http://localhost/todos/?insert=1", {
        method: "POST",
        body: JSON.stringify(dataSend),
      })
        .then((response) => response.json())
        .then((dataResponse) => {
          console.log(dataResponse);
          window.location.href = "todoList";
        });
    },
  },
};
</script>