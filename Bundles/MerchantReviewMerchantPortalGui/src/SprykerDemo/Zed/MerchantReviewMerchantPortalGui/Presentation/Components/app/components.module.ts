import { NgModule } from '@angular/core';
import { WebComponentsModule } from '@spryker/web-components';

import { MerchantReviewMerchantPortalComponent } from './merchant-review-merchant-portal/merchant-review-merchant-portal.component';
import { MerchantReviewMerchantPortalModule } from './merchant-review-merchant-portal/merchant-review-merchant-portal.module';

@NgModule({
    imports: [
        WebComponentsModule.withComponents([MerchantReviewMerchantPortalComponent]),
        MerchantReviewMerchantPortalModule,
    ],
})
export class ComponentsModule {}
