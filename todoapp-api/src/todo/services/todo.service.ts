import { Injectable } from '@nestjs/common';
import { InjectRepository } from '@nestjs/typeorm';
import { Repository } from 'typeorm';
import { Todo } from './../entities/todo.entity';

@Injectable()
export class TodoService {
    constructor(
        @InjectRepository(Todo) private todoRepo: Repository<Todo>
    ) { }

    findAll() {
        return this.todoRepo.find();
    }

    findOne(id: number) {
        return this.todoRepo.findOne(id);
    }

    create(body: any) {
        const newTodo = new Todo();
        newTodo.name = body.name;
        return this.todoRepo.save(newTodo);
    }

    async update(id: number, body: any) {
        const todo = await this.todoRepo.findOne(id);
        this.todoRepo.merge(todo, body);
        return this.todoRepo.save(todo);
    }

    async delete(id: number) {
        await this.todoRepo.delete(id);
        return true;
    }
}
