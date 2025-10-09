import React from "react";
import { SidebarProvider } from "@/components/ui/sidebar";
import { AppSidebar } from "@/components/app-sidebar";
import { SidebarInset } from "@/components/ui/sidebar";
import { SiteHeader } from "@/components/site-header";
import { usePage } from "@inertiajs/react";
import DynamicDataTable from "@/components/DynamicDataTable";

export default function Reviews() {
    const { reviews } = usePage().props;

    // Flatten relational data for the table
    const flattenedReviews = reviews.map((r) => ({
        id: r.id,
        guest_name: r.user?.name || "N/A",
        property_title: r.booking?.property?.title || "N/A",
        rating: r.rating,
        comment: r.comment || "N/A",
        created_at: r.created_at,
    }));

    const columns = flattenedReviews.length ? Object.keys(flattenedReviews[0]) : [];

    const columnLabels = {
        id: "ID",
        guest_name: "Guest",
        property_title: "Property",
        rating: "Rating",
        comment: "Comment",
        created_at: "Created At",
    };

    return (
        <SidebarProvider>
            <AppSidebar variant="inset" />
            <SidebarInset>
                <SiteHeader />
                <div className="p-6">
                    <h1 className="text-2xl font-semibold mb-4">Reviews</h1>
                    <p className="text-slate-600 mb-6">
                        Here you can manage all Reviews.
                    </p>

                    <div className="flex flex-col gap-4 py-4 md:gap-6 md:py-6">
                        <DynamicDataTable
                            data={flattenedReviews}
                            columns={columns}
                            editRoute="/admin/reviews"
                            deleteRoute="/admin/reviews"
                            columnLabels={columnLabels}
                        />
                    </div>
                </div>
            </SidebarInset>
        </SidebarProvider>
    );
}
