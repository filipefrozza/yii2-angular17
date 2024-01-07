import { Component, EventEmitter, Input, Output } from '@angular/core';
import { BooksService } from '../book.service';
import { HttpResponse } from '@angular/common/http';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrl: './register.component.css'
})
export class BooksRegisterComponent {
  @Input() book = {
    id: false,
    title: '',
    description: '',
    author: '',
    pages: ''
  };
  @Output() bookSalvo = new EventEmitter();

  editMode = false;

  constructor(private booksService: BooksService, private aRouter: ActivatedRoute, private router: Router) {}

  ngOnInit(){
    this.aRouter.params.subscribe(params => {
      if (params['id']) {
        this.booksService.getBook(params['id']).subscribe(data => {
          this.book = data;
          this.editMode = true;
        });
      }
    });
  }

  saveBook() {
    if (this.editMode) {
      this.booksService.updateBook(this.book).subscribe((response) => {
        console.log(response);
        if (response.status == 201) {
          alert("Updated");
          this.bookSalvo.emit();
          this.router.navigate(['/books']);
        } else {
          alert("Update error");
        }
      });
    } else {
      let _test = this.booksService.createBook(this.book);
      _test
      .subscribe((response: HttpResponse<any>) => {
        console.log(response);
        if (response.status == 201) {
          alert("Saved");
          this.bookSalvo.emit();
          this.router.navigate(['/books']);
        } else {
          alert("Save error");
        }
      });
    }
  }
}
