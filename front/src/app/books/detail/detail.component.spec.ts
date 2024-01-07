import { ComponentFixture, TestBed } from '@angular/core/testing';

import { BooksDetailComponent } from './detail.component';

describe('DetalhesComponent', () => {
  let component: BooksDetailComponent;
  let fixture: ComponentFixture<BooksDetailComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [BooksDetailComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(BooksDetailComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
