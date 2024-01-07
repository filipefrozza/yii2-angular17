import { Component, Input } from '@angular/core';
import { BooksService } from '../book.service';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-detail',
  templateUrl: './detail.component.html',
  styleUrl: './detail.component.css'
})
export class BooksDetailComponent {
  @Input() book: any;
  
  constructor(private booksService: BooksService, private router: ActivatedRoute) {}

  ngOnInit() {
    this.router.params.subscribe(params => {
      this.loadBook(+params['id']);
    });
  }

  loadBook(id:any) {
    this.booksService.getBook(id).subscribe(data => {
      this.book = data;
    });
  }
}