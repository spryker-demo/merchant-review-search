import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HeadlineModule } from '@spryker/headline';
import { MerchantReviewMerchantPortalComponent } from './merchant-review-merchant-portal.component';
import { MerchantReviewMerchantPortalTableModule } from '../merchant-review-merchant-portal-table/merchant-review-merchant-portal-table.module';

@NgModule({
    declarations: [MerchantReviewMerchantPortalComponent],
    exports: [MerchantReviewMerchantPortalComponent],
    imports: [CommonModule, HeadlineModule, MerchantReviewMerchantPortalTableModule],
})
export class MerchantReviewMerchantPortalModule {}
