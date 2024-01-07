import { ComponentFixture, TestBed } from '@angular/core/testing';

import { BooksListComponent } from './list.component';

describe('ListarComponent', () => {
  let component: BooksListComponent;
  let fixture: ComponentFixture<BooksListComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [BooksListComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(BooksListComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
