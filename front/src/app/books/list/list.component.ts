import { Component, OnInit } from '@angular/core';
import { BooksService } from '../book.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-book-list',
  templateUrl: './list.component.html',
  styleUrl: './list.component.css'
})

export class BooksListComponent implements OnInit {
  books: any[] = [];
  loaded = false;
  noBooks = true;

  constructor(private booksService: BooksService, private router: Router) {}

  ngOnInit() {
    this.loadBooks();
  }

  loadBooks() {
    this.booksService.getBooks().subscribe(data => {
      this.books = data;
      this.loaded = true;
      this.noBooks = data.length == 0;
    });
  }
  
  seeDetails(id: number) {
    this.router.navigate(['/books', id]);
  }

  editBook(id: number) {
    this.router.navigate(['/books/edit', id]);
  }
  
  removeBook(id: number) {
    this.booksService.removeBook({id: id}).subscribe((response) => {
      if (response.status == 200) {
        this.loadBooks();
      }
    });
  }
}