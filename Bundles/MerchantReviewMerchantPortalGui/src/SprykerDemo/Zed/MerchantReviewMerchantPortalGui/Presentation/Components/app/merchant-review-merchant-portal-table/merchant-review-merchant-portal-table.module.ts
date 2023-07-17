import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { TableModule } from '@spryker/table';
import { MerchantReviewMerchantPortalTableComponent } from './merchant-review-merchant-portal-table.component';

@NgModule({
    imports: [CommonModule, TableModule],
    declarations: [MerchantReviewMerchantPortalTableComponent],
    exports: [MerchantReviewMerchantPortalTableComponent],
})
export class MerchantReviewMerchantPortalTableModule { }
