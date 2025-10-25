import React from "react";
import { SidebarProvider } from "@/components/ui/sidebar";
import { AppSidebar } from "@/components/app-sidebar";
import { SidebarInset } from "@/components/ui/sidebar";
import { SiteHeader } from "@/components/site-header";
import { usePage, router } from "@inertiajs/react";
import toast, { Toaster } from "react-hot-toast";

export default function ShowAmenity() {
    const { amenity, flash } = usePage().props;

    return (
        <SidebarProvider>
            <AppSidebar variant="inset" />
            <SidebarInset>
                <SiteHeader />

                <div className="p-6">
                    <div className="flex justify-between items-center mb-6">
                        <h1 className="text-2xl font-semibold">Amenity Details</h1>
                        <button
                            onClick={() => router.get("/amenities")}
                            className="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300"
                        >
                            ← Back
                        </button>
                    </div>

                    <div className="bg-white shadow-md rounded-lg p-6 max-w-lg">
                        <h2 className="text-xl font-bold text-indigo-700 mb-4">
                            {amenity.name}
                        </h2>

                        <div className="text-gray-700 space-y-2">
                            <p>
                                <strong>ID:</strong> {amenity.id}
                            </p>
                            <p>
                                <strong>Created at:</strong>{" "}
                                {new Date(amenity.created_at).toLocaleString()}
                            </p>
                            <p>
                                <strong>Updated at:</strong>{" "}
                                {new Date(amenity.updated_at).toLocaleString()}
                            </p>
                        </div>

                        <div className="mt-6 flex gap-3">
                            <button
                                onClick={() =>
                                    router.get(`/amenities/${amenity.id}/edit`)
                                }
                                className="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700"
                            >
                                Edit
                            </button>

                            <button
                                onClick={() => {
                                    if (
                                        confirm("Are you sure you want to delete this amenity?")
                                    ) {
                                        router.delete(`/amenities/${amenity.id}`, {
                                            onSuccess: () => toast.success("Amenity deleted"),
                                            onError: () => toast.error("Failed to delete"),
                                        });
                                    }
                                }}
                                className="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700"
                            >
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </SidebarInset>

            <Toaster position="top-right" />
        </SidebarProvider>
    );
}
