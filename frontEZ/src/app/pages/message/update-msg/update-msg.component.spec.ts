import { ComponentFixture, TestBed } from '@angular/core/testing';

import { UpdateMsgComponent } from './update-msg.component';

describe('UpdateMsgComponent', () => {
  let component: UpdateMsgComponent;
  let fixture: ComponentFixture<UpdateMsgComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [UpdateMsgComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(UpdateMsgComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
