import React, { useState, useEffect } from "react";
import { usePage, router } from "@inertiajs/react";
import toast, { Toaster } from "react-hot-toast";
import { SidebarProvider } from "@/components/ui/sidebar";
import { AppSidebar } from "@/components/app-sidebar";
import { SidebarInset } from "@/components/ui/sidebar";
import { SiteHeader } from "@/components/site-header";

export default function EditProperty() {
    const { property, amenities, flash } = usePage().props;

    // Form state
    const [title, setTitle] = useState(property.title || "");
    const [description, setDescription] = useState(property.description || "");
    const [price, setPrice] = useState(property.price_per_night || "");
    const [maxGuests, setMaxGuests] = useState(property.max_guests || 1);
    const [city, setCity] = useState(property.city || "");
    const [country, setCountry] = useState(property.country || "");
    const [address, setAddress] = useState(property.address || "");
    const [selectedAmenities, setSelectedAmenities] = useState(
        property.amenities.map((a) => a.id) || []
    );
    const [images, setImages] = useState([]); // new images
    const [removeImages, setRemoveImages] = useState([]); // existing images to remove

    // Toast messages
    useEffect(() => {
        if (flash?.success) toast.success(flash.success);
        if (flash?.error) toast.error(flash.error);
    }, [flash]);

    const handleAmenityChange = (id) => {
        if (selectedAmenities.includes(id)) {
            setSelectedAmenities(selectedAmenities.filter((a) => a !== id));
        } else {
            setSelectedAmenities([...selectedAmenities, id]);
        }
    };

    const handleFileChange = (e) => {
        setImages(Array.from(e.target.files));
    };

    const handleRemoveImage = (imgId) => {
        setRemoveImages([...removeImages, imgId]);
    };

    const handleSubmit = (e) => {
    e.preventDefault();

    const formData = new FormData();
    
    formData.append("_method", "PUT");
    formData.append("user_id", property.user_id);
    formData.append("title", title);
    formData.append("description", description);
    formData.append("price_per_night", price);
    formData.append("max_guests", maxGuests);
    formData.append("city", city);
    formData.append("country", country);
    formData.append("address", address);
    selectedAmenities.forEach((id) => formData.append("amenities[]", id));
    removeImages.forEach((id) => formData.append("remove_images[]", id));
    images.forEach((file) => formData.append("images[]", file));

    router.post(`/properties/${property.id}`, formData, {
        forceFormData: true,
        preserveScroll: true,
        onSuccess: () => toast.success("Property updated successfully!"),
        onError: (errors) => {
            console.log("Errors:", errors);
            toast.error("There were errors in your submission");
        },
    });
};

    return (
        <SidebarProvider>
            <AppSidebar variant="inset" />
            <SidebarInset>
                <SiteHeader />

                <div className="p-6">
                    <h1 className="text-2xl font-semibold mb-4">Edit Property</h1>

                    <form
                        onSubmit={handleSubmit}
                        className="bg-white shadow-md rounded-lg p-6 space-y-4 max-w-3xl"
                    >
                        <div>
                            <label className="block text-sm font-medium text-gray-700">
                                Title
                            </label>
                            <input
                                type="text"
                                value={title}
                                onChange={(e) => setTitle(e.target.value)}
                                className="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2"
                                required
                            />
                        </div>

                        <div>
                            <label className="block text-sm font-medium text-gray-700">
                                Description
                            </label>
                            <textarea
                                value={description}
                                onChange={(e) => setDescription(e.target.value)}
                                className="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2"
                            />
                        </div>

                        <div className="grid grid-cols-2 gap-4">
                            <div>
                                <label className="block text-sm font-medium text-gray-700">
                                    Price per Night
                                </label>
                                <input
                                    type="number"
                                    value={price}
                                    onChange={(e) => setPrice(e.target.value)}
                                    className="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2"
                                    required
                                />
                            </div>

                            <div>
                                <label className="block text-sm font-medium text-gray-700">
                                    Max Guests
                                </label>
                                <input
                                    type="number"
                                    value={maxGuests}
                                    onChange={(e) => setMaxGuests(e.target.value)}
                                    className="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2"
                                    min={1}
                                />
                            </div>
                        </div>

                        <div className="grid grid-cols-2 gap-4">
                            <div>
                                <label className="block text-sm font-medium text-gray-700">
                                    City
                                </label>
                                <input
                                    type="text"
                                    value={city}
                                    onChange={(e) => setCity(e.target.value)}
                                    className="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2"
                                />
                            </div>

                            <div>
                                <label className="block text-sm font-medium text-gray-700">
                                    Country
                                </label>
                                <input
                                    type="text"
                                    value={country}
                                    onChange={(e) => setCountry(e.target.value)}
                                    className="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2"
                                />
                            </div>
                        </div>

                        <div>
                            <label className="block text-sm font-medium text-gray-700">
                                Address
                            </label>
                            <input
                                type="text"
                                value={address}
                                onChange={(e) => setAddress(e.target.value)}
                                className="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2"
                            />
                        </div>

                        <div>
                            <label className="block text-sm font-medium text-gray-700 mb-1">
                                Amenities
                            </label>
                            <div className="flex flex-wrap gap-2">
                                {amenities.map((a) => (
                                    <label key={a.id} className="flex items-center gap-1">
                                        <input
                                            type="checkbox"
                                            checked={selectedAmenities.includes(a.id)}
                                            onChange={() => handleAmenityChange(a.id)}
                                        />
                                        <span>{a.name}</span>
                                    </label>
                                ))}
                            </div>
                        </div>

                        <div>
                            <label className="block text-sm font-medium text-gray-700 mb-1">
                                Existing Images
                            </label>
                            <div className="flex gap-2 mb-2">
                                {property.images.map((img) => (
                                    !removeImages.includes(img.id) && (
                                        <div key={img.id} className="relative">
                                            <img
                                                src={img.image_url.startsWith("http") ? img.image_url : `/storage/${img.image_url}`}
                                                alt={property.title}
                                                className="w-16 h-16 object-cover rounded border"
                                            />
                                            <button
                                                type="button"
                                                onClick={() => handleRemoveImage(img.id)}
                                                className="absolute top-0 right-0 bg-red-600 text-white rounded-full w-5 h-5 text-xs flex items-center justify-center"
                                            >
                                                ×
                                            </button>
                                        </div>
                                    )
                                ))}
                            </div>
                            <label className="block text-sm font-medium text-gray-700 mb-1">
                                Add New Images
                            </label>
                            <input
                                type="file"
                                multiple
                                onChange={handleFileChange}
                                className="mt-1 block w-full"
                            />
                        </div>

                        <div className="flex justify-end space-x-3">
                            <button
                                type="button"
                                onClick={() => router.get("/properties")}
                                className="border px-4 py-2 rounded-lg"
                            >
                                Cancel
                            </button>
                            <button
                                type="submit"
                                className="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700"
                            >
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </SidebarInset>

            <Toaster position="top-right" />
        </SidebarProvider>
    );
}
