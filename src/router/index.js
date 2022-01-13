import { createRouter, createWebHistory } from 'vue-router'
import AddTodo from '../components/AddTodo.vue'
import EditTodo from '../components/EditTodo.vue'
import TodoList from '../components/TodoList.vue'

const routes = [
  {
    path: '/addTodo',
    name: 'AddTodo',
    component: AddTodo
  },
  {
    path: '/editTodo/:id',
    name: 'EditTodo',
    component: EditTodo
  },
  {
    path: '/todoList',
    name: 'TodoList',
    component: TodoList
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
