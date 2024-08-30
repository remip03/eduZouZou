import { ComponentFixture, TestBed } from '@angular/core/testing';

import { MessagesTablesComponent } from './messages-tables.component';

describe('MessagesTablesComponent', () => {
  let component: MessagesTablesComponent;
  let fixture: ComponentFixture<MessagesTablesComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [MessagesTablesComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(MessagesTablesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
