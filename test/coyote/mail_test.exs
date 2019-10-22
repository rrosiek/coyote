defmodule Coyote.MailTest do
  use Coyote.DataCase

  alias Coyote.Mail

  describe "correspondence" do
    alias Coyote.Mail.Correspondence

    @valid_attrs %{subject: "some subject"}
    @update_attrs %{subject: "some updated subject"}
    @invalid_attrs %{subject: nil}

    def correspondence_fixture(attrs \\ %{}) do
      {:ok, correspondence} =
        attrs
        |> Enum.into(@valid_attrs)
        |> Mail.create_correspondence()

      correspondence
    end

    test "list_correspondence/0 returns all correspondence" do
      correspondence = correspondence_fixture()
      assert Mail.list_correspondence() == [correspondence]
    end

    test "get_correspondence!/1 returns the correspondence with given id" do
      correspondence = correspondence_fixture()
      assert Mail.get_correspondence!(correspondence.id) == correspondence
    end

    test "create_correspondence/1 with valid data creates a correspondence" do
      assert {:ok, %Correspondence{} = correspondence} = Mail.create_correspondence(@valid_attrs)
      assert correspondence.subject == "some subject"
    end

    test "create_correspondence/1 with invalid data returns error changeset" do
      assert {:error, %Ecto.Changeset{}} = Mail.create_correspondence(@invalid_attrs)
    end

    test "update_correspondence/2 with valid data updates the correspondence" do
      correspondence = correspondence_fixture()
      assert {:ok, %Correspondence{} = correspondence} = Mail.update_correspondence(correspondence, @update_attrs)
      assert correspondence.subject == "some updated subject"
    end

    test "update_correspondence/2 with invalid data returns error changeset" do
      correspondence = correspondence_fixture()
      assert {:error, %Ecto.Changeset{}} = Mail.update_correspondence(correspondence, @invalid_attrs)
      assert correspondence == Mail.get_correspondence!(correspondence.id)
    end

    test "delete_correspondence/1 deletes the correspondence" do
      correspondence = correspondence_fixture()
      assert {:ok, %Correspondence{}} = Mail.delete_correspondence(correspondence)
      assert_raise Ecto.NoResultsError, fn -> Mail.get_correspondence!(correspondence.id) end
    end

    test "change_correspondence/1 returns a correspondence changeset" do
      correspondence = correspondence_fixture()
      assert %Ecto.Changeset{} = Mail.change_correspondence(correspondence)
    end
  end
end
