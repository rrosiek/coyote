defmodule Coyote.UploadsTest do
  use Coyote.DataCase

  alias Coyote.Uploads

  describe "files" do
    alias Coyote.Uploads.File

    @valid_attrs %{description: "some description"}
    @update_attrs %{description: "some updated description"}
    @invalid_attrs %{description: nil}

    def file_fixture(attrs \\ %{}) do
      {:ok, file} =
        attrs
        |> Enum.into(@valid_attrs)
        |> Uploads.create_file()

      file
    end

    test "list_files/0 returns all files" do
      file = file_fixture()
      assert Uploads.list_files() == [file]
    end

    test "get_file!/1 returns the file with given id" do
      file = file_fixture()
      assert Uploads.get_file!(file.id) == file
    end

    test "create_file/1 with valid data creates a file" do
      assert {:ok, %File{} = file} = Uploads.create_file(@valid_attrs)
      assert file.description == "some description"
    end

    test "create_file/1 with invalid data returns error changeset" do
      assert {:error, %Ecto.Changeset{}} = Uploads.create_file(@invalid_attrs)
    end

    test "update_file/2 with valid data updates the file" do
      file = file_fixture()
      assert {:ok, %File{} = file} = Uploads.update_file(file, @update_attrs)
      assert file.description == "some updated description"
    end

    test "update_file/2 with invalid data returns error changeset" do
      file = file_fixture()
      assert {:error, %Ecto.Changeset{}} = Uploads.update_file(file, @invalid_attrs)
      assert file == Uploads.get_file!(file.id)
    end

    test "delete_file/1 deletes the file" do
      file = file_fixture()
      assert {:ok, %File{}} = Uploads.delete_file(file)
      assert_raise Ecto.NoResultsError, fn -> Uploads.get_file!(file.id) end
    end

    test "change_file/1 returns a file changeset" do
      file = file_fixture()
      assert %Ecto.Changeset{} = Uploads.change_file(file)
    end
  end

  describe "minutes" do
    alias Coyote.Uploads.Minute

    @valid_attrs %{meeting_date: ~N[2010-04-17 14:00:00]}
    @update_attrs %{meeting_date: ~N[2011-05-18 15:01:01]}
    @invalid_attrs %{meeting_date: nil}

    def minute_fixture(attrs \\ %{}) do
      {:ok, minute} =
        attrs
        |> Enum.into(@valid_attrs)
        |> Uploads.create_minute()

      minute
    end

    test "list_minutes/0 returns all minutes" do
      minute = minute_fixture()
      assert Uploads.list_minutes() == [minute]
    end

    test "get_minute!/1 returns the minute with given id" do
      minute = minute_fixture()
      assert Uploads.get_minute!(minute.id) == minute
    end

    test "create_minute/1 with valid data creates a minute" do
      assert {:ok, %Minute{} = minute} = Uploads.create_minute(@valid_attrs)
      assert minute.meeting_date == ~N[2010-04-17 14:00:00]
    end

    test "create_minute/1 with invalid data returns error changeset" do
      assert {:error, %Ecto.Changeset{}} = Uploads.create_minute(@invalid_attrs)
    end

    test "update_minute/2 with valid data updates the minute" do
      minute = minute_fixture()
      assert {:ok, %Minute{} = minute} = Uploads.update_minute(minute, @update_attrs)
      assert minute.meeting_date == ~N[2011-05-18 15:01:01]
    end

    test "update_minute/2 with invalid data returns error changeset" do
      minute = minute_fixture()
      assert {:error, %Ecto.Changeset{}} = Uploads.update_minute(minute, @invalid_attrs)
      assert minute == Uploads.get_minute!(minute.id)
    end

    test "delete_minute/1 deletes the minute" do
      minute = minute_fixture()
      assert {:ok, %Minute{}} = Uploads.delete_minute(minute)
      assert_raise Ecto.NoResultsError, fn -> Uploads.get_minute!(minute.id) end
    end

    test "change_minute/1 returns a minute changeset" do
      minute = minute_fixture()
      assert %Ecto.Changeset{} = Uploads.change_minute(minute)
    end
  end

  describe "newsletters" do
    alias Coyote.Uploads.Newsletter

    @valid_attrs %{name: "some name"}
    @update_attrs %{name: "some updated name"}
    @invalid_attrs %{name: nil}

    def newsletter_fixture(attrs \\ %{}) do
      {:ok, newsletter} =
        attrs
        |> Enum.into(@valid_attrs)
        |> Uploads.create_newsletter()

      newsletter
    end

    test "list_newsletters/0 returns all newsletters" do
      newsletter = newsletter_fixture()
      assert Uploads.list_newsletters() == [newsletter]
    end

    test "get_newsletter!/1 returns the newsletter with given id" do
      newsletter = newsletter_fixture()
      assert Uploads.get_newsletter!(newsletter.id) == newsletter
    end

    test "create_newsletter/1 with valid data creates a newsletter" do
      assert {:ok, %Newsletter{} = newsletter} = Uploads.create_newsletter(@valid_attrs)
      assert newsletter.name == "some name"
    end

    test "create_newsletter/1 with invalid data returns error changeset" do
      assert {:error, %Ecto.Changeset{}} = Uploads.create_newsletter(@invalid_attrs)
    end

    test "update_newsletter/2 with valid data updates the newsletter" do
      newsletter = newsletter_fixture()
      assert {:ok, %Newsletter{} = newsletter} = Uploads.update_newsletter(newsletter, @update_attrs)
      assert newsletter.name == "some updated name"
    end

    test "update_newsletter/2 with invalid data returns error changeset" do
      newsletter = newsletter_fixture()
      assert {:error, %Ecto.Changeset{}} = Uploads.update_newsletter(newsletter, @invalid_attrs)
      assert newsletter == Uploads.get_newsletter!(newsletter.id)
    end

    test "delete_newsletter/1 deletes the newsletter" do
      newsletter = newsletter_fixture()
      assert {:ok, %Newsletter{}} = Uploads.delete_newsletter(newsletter)
      assert_raise Ecto.NoResultsError, fn -> Uploads.get_newsletter!(newsletter.id) end
    end

    test "change_newsletter/1 returns a newsletter changeset" do
      newsletter = newsletter_fixture()
      assert %Ecto.Changeset{} = Uploads.change_newsletter(newsletter)
    end
  end
end
