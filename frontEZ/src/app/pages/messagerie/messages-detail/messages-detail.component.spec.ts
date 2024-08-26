import { ComponentFixture, TestBed } from '@angular/core/testing';

import { MessagesDetailComponent } from './messages-detail.component';

describe('MessagesDetailComponent', () => {
  let component: MessagesDetailComponent;
  let fixture: ComponentFixture<MessagesDetailComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [MessagesDetailComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(MessagesDetailComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
